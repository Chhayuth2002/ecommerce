<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // $include = $request->query('include');

        // if ($include) {
        //     $categories->with('children');
        // }

        // $paginatedCategories = $categories->paginate()->appends($request->query());
        $categories = Category::with('children')->where('parent_id', null)->orderBy('name', 'asc')->get();

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $category->loadMissing('products');
        return new CategoryResource($category);
    }
}
