<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthIsAdmin::class);
    }

    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')
            ->paginate();

        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    public function create(Request $request)
    {
        $post = new Post();

        return view('admin.posts.form', [
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->user_id = auth()->id();
        $post->title = $request->input('title');
        if ($request->filled('slug'))
        {
            $post->slug = $request->input('slug');
        }
        else {
            $post->slug = Str::slug($post->title);
        }
        $post->content = $request->input('content');
        if ($request->has('publish'))
        {
            $post->published_at = now()->toDateTimeString();
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', "Posting telah disimpan");
    }

    public function edit(Request $request, Post $post)
    {
        return view('admin.posts.form', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->user_id = auth()->id();
        $post->title = $request->input('title');
        if ($request->filled('slug'))
        {
            $post->slug = $request->input('slug');
        }
        else {
            $post->slug = Str::slug($post->title);
        }
        $post->content = $request->input('content');
        if ($request->has('publish'))
        {
            $post->published_at = now()->toDateTimeString();
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', "Posting telah disimpan");
    }

    public function togglePublish(Post $post)
    {
        if (!$post->published_at)
        {
            $post->published_at = now()->toDateTimeString();
        }
        else {
            $post->published_at = null;
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', "Posting telah disimpan");
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', "Posting telah dihapus");
    }
}
