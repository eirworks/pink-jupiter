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
            ->orderBy('name', 'asc')
            ->with(['children' => function($query) {
                $query->select('id','name','parent_id','ordering','group_order')
                    ->orderBy('group_order', 'asc')
                    ->orderBy('ordering', 'asc');
            }])
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
