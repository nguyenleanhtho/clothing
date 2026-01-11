<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCategory' => 'required|uuid|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'id' => Str::uuid(),
            'idCategory' => $request->idCategory,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success', 'Thêm sản phẩm thành công');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'idCategory' => 'required|uuid|exists:categories,id',
        ]);

        $p = Product::findOrFail($id);
        $p->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'idCategory' => $request->idCategory,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Đã cập nhật');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Đã xoá');
    }
}