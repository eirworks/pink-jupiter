<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')
            ->where('parent_id', 0)
            ->with(['children:id,name,parent_id'])
            ->get();

        return response()->json($categories);
    }

    public function subcategories()
    {
        $categories = Category::select('id', 'name')
            ->where('parent_id', '>', 0)
            ->get();

        return response()->json($categories);
    }
}
