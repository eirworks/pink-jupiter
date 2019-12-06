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

    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'desc')
            ->when($request->filled('parent_id'), function($query) use($request) {
                $query->where('parent_id', $request->input('parent_id'));
            })
            ->with(['parent'])
            ->withCount(['children'])
            ->paginate();

        $parent = null;
        if ($request->filled('parent_id'))
        {
            $parent = Category::findOrFail($request->input('parent_id'));
        }

        return view('admin.categories.index', [
            'categories' => $categories,
            'parent' => $parent,
        ]);
    }

    public function create(Request $request)
    {
        $category = new Category();
        $parent = null;
        if ($request->filled('parent_id'))
        {
            $parent = Category::findOrFail($request->input('parent_id'));
        }

        return view('admin.categories.form', [
            'category' => $category,
            'parent' => $parent,
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = $request->input('parent_id', 0);
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
