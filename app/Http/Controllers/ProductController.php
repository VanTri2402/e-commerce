<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * 1. Hiển thị danh sách sản phẩm (mới nhất xếp trước)
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * 2. Hiển thị giao diện Form thêm sản phẩm mới
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * 3. Tiếp nhận, kiểm tra tính hợp lệ (Validation) và lưu sản phẩm mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'price.required' => 'Vui lòng nhập đơn giá.',
            'price.numeric' => 'Đơn giá phải là số hợp lệ.',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm mới thành công!');
    }

    /**
     * 4. Xem chi tiết thông tin một sản phẩm
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * 5. Hiển thị giao diện Form chỉnh sửa sản phẩm
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * 6. Kiểm tra dữ liệu cập nhật (update) và lưu thay đổi vào cơ sở dữ liệu
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'price.required' => 'Vui lòng nhập đơn giá.',
            'price.numeric' => 'Đơn giá phải là số hợp lệ.',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Cập nhật thông tin sản phẩm thành công!');
    }

    /**
     * 7. Xóa sản phẩm khỏi hệ thống
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm thành công!');
    }
}