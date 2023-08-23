<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Traits\UploadFile;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
	use UploadFile;

	public function home()
	{
		$products = Product::with('category', 'file')
			->where('stock', '>', 0)
			->get();
		return view('index', compact('products'));
	}

	public function index()
	{
		$categories = Category::get();
		$products = Product::with('category', 'file')->get();
		return view('products.index', compact('products', 'categories'));
	}

	public function category(Category $category)
	{
		$products = $category->products()->where('stock', '>', 0)->paginate(0);
		return view('categories.productCategory', compact('products', 'category'));
	}

	public function store(ProductRequest $request)
	{
		try {
			DB::beginTransaction();
			$product = new Product($request->all());
			$product->save();
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 200);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function show($product)
	{
		$product = Product::findOrFail($product);
		return view('product.index', compact('product'));
	}

	public function update(ProductUpdateRequest $request, Product $product)
	{
		try {
			DB::beginTransaction();
			$product->update($request->all());
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollBack();
			throw $th;
		}
	}

	public function destroy(Product $product)
	{
		$product->delete();
		$this->deleteFile($product);
		return response()->json([], 204);
	}
}
