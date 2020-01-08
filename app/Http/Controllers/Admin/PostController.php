<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use App\Post;
use App\PostCategory;
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
            ->with(['category:id,name'])
            ->when($request->has('page'), function($query) {
                $query->where('page', true);
            }, function($query) {
                $query->where('page', false);
            })
            ->paginate();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create(Request $request)
    {
        $post = new Post();
        if ($request->has('page'))
        {
            $post->page = true;
        }

        $categories = PostCategory::get();

        return view('admin.posts.form', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->user_id = auth()->id();
        $post->page = $request->input('page', false);
        $post->post_category_id = $this->setupCategory($request);
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

        $post->data = $request->input('data');
        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', "Posting telah disimpan");
    }

    public function edit(Request $request, Post $post)
    {
        $categories = PostCategory::get();
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->user_id = auth()->id();
        if (!$post->page)
        {
            $post->post_category_id = $this->setupCategory($request);
        }
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

        $post->data = $request->input('data');
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

    /**
     * Setup category automatically
     * @param Request $request
     * @return int|mixed
     */
    private function setupCategory(Request $request)
    {
        $id = intval($request->input('post_category_id'));

        if ($id == -1)
        {
            // if new category is empty, just return zero
            if (!$request->filled('category_name'))
            {
                return 0;
            }

            // create new category
            $category = new PostCategory();
            $category->name = $request->input('category_name');
            $category->slug = Str::slug($category->name);

            $category->save();

            return $category->id;
        }
        else {
            // return selected id
            return $id;
        }
    }
}
