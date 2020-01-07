<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

class CategoryListingController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)
            ->with(['children'])
            ->get();

        return view('category_listing.index', [
            'categories' => $categories,
        ]);
    }

    public function show(Request $request, Category $category)
    {
        $users = User::orderBy('id', 'desc')
            ->whereHas('categories', function($query) use($category) {
                $query->where('category_id', $category->id);
            })
            ->paginate();

        $request->merge([
            'category_id' => $category->id,
        ]);

        return view('home', [
            'category' => $category,
            'users' => $users,
        ]);
    }
}
