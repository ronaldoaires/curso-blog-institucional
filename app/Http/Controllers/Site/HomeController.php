<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {

    $posts = Post::query()
        ->where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

        return view('site.home', compact('posts'));
    }
}
