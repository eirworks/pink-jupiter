<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthIsAdmin::class);
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $category = new Category();

        return view('admin.categories.form', [
            'category' => $category,
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = 0;
        if ($request->filled('slug'))
        {
            $category->slug = $request->input('slug');
        }
        else {
            $category->slug = Str::slug($request->input('slug'));
        }
        $category->image = "";
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with(['success' => "Kategori telah disimpan"]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = 0;
        if ($request->filled('slug'))
        {
            $category->slug = $request->input('slug');
        }
        else {
            $category->slug = Str::slug($request->input('slug'));
        }
        $category->image = "";
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with(['success' => "Kategori telah disimpan"]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', "Kategori telah dihapus");
    }
}
