<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Danh sách sản phẩm sắp hết hàng
     */
    public function lowStock()
    {
        $products = Product::with('category')
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->get();

        return view('admin.products.low-stock', compact('products'));
    }

    /**
     * Form tạo mới sản phẩm
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }


    /**
     * Lưu sản phẩm
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 1. Tạo product trước
        $product = Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
        ]);

        // 2. Upload ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_url'    => $image->store('products', 'public'),
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công');
    }


    /**
     * Chi tiết sản phẩm
     */
    public function show(Product $product)
    {
        $product->load('images', 'category');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Form sửa sản phẩm
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');

        return view('admin.products.edit', compact('product', 'categories'));
    }


    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'price'       => 'required',
            'stock'       => 'required',
            'images.*'    => 'nullable|image',
        ]);

        $product->update($request->only(
            'category_id',
            'name',
            'price',
            'stock',
            'description'
        ));

        // Xóa ảnh được chọn
        if ($request->has('delete_images')) {
            ProductImage::whereIn('id', $request->delete_images)->delete();
        }

        // Upload thêm ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_url'    => $img->store('products', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Cập nhật thành công');
    }



    /**
     * Xóa sản phẩm
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công');
    }
}
