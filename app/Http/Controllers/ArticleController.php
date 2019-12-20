<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')
            ->whereNotNull('published_at')
            ->paginate();

        return view('articles.index', [
            'posts' => $posts
        ]);
    }

    public function show($slug, Post $post)
    {
        return view('articles.index', [
            'post' => $post,
        ]);
    }
}
