<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
		$categories = Category::get();
        if(!$request->ajax()) return view('categories.index', compact('categories'));
		return response()->json(['categories' => $categories], 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
		$category->save();
		return response()->json([], 201);
    }

    public function show(Request $request, Category $category)
    {
		return response()->json(['category' => $category], 200);
    }

	public function getAll() {
		$categories = Category::has('products', '>', 0)->get();
		return view('categories.getAll', compact('categories'));
	}


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
		if(!$request->ajax()) return back()->with('success', 'Category updated');
		return response()->json([], 204);
    }

    public function destroy(Category $category)
    {
        $category->delete();
		return response()->json([], 204);
    }
}
