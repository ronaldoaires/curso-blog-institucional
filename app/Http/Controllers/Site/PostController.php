<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a paginated listing of active posts.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->where('is_active', true)
            ->with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('site.posts.index', compact('posts'));
    }

    /**
     * Display a single post by its slug.
     */
    public function show(string $slug): View
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'user'])
            ->firstOrFail();

        // Increment views and register last visit timestamp
        $post->increment('views');
        $post->update(['last_visit_at' => now()]);

        // Related posts from the same category, excluding the current one
        $relatedPosts = Post::query()
            ->where('is_active', true)
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('site.posts.show', compact('post', 'relatedPosts'));
    }
}