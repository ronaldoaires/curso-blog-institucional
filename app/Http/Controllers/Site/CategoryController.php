<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a paginated listing of active categories.
     */
    public function index(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->withCount(['posts' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->paginate(12);

        return view('site.categories.index', compact('categories'));
    }

    /**
     * Display a paginated listing of posts for a given category.
     */
    public function show(string $slug): View
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('parent')
            ->firstOrFail();

        $posts = Post::query()
            ->where('is_active', true)
            ->where('category_id', $category->id)
            ->with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('site.categories.show', compact('category', 'posts'));
    }
}