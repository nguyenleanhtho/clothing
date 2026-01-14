<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * Danh sách danh mục
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Form tạo mới
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu danh mục
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            // slug tự sinh trong Model
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Form sửa
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật danh mục
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            // slug tự cập nhật trong Model
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Xóa danh mục
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công');
    }
}
