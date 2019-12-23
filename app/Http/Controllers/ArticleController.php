<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')
            ->whereNotNull('published_at')
            ->when($request->filled('category_id'), function($query) {
                $query->where('post_category_id', \request()->input('category_id'));
            })
            ->paginate();

        $categories = PostCategory::get();

        return view('articles.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function show($slug, Post $post)
    {
        $post->load('category');

        $categories = PostCategory::get();

        $url = route('articles.show', ['slug' => $post->slug, $post]);

        return view('articles.index', [
            'post' => $post,
            'categories' => $categories,
            'url' => $url,
        ]);
    }

    public function showPage($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('page', true)
            ->firstOrFail();

        $url = route('articles.show', ['slug' => $post->slug, $post]);

        return view('articles.index', [
            'post' => $post,
            'categories' => [],
            'url' => $url,
        ]);
    }
}
