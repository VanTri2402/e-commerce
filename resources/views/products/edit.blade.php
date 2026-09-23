@extends('layouts.app')
@section('title', 'Chỉnh sửa: ' . $product->name)
@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl border border-gray-200 shadow-sm">
    <h1 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-100">Chỉnh sửa sản phẩm #{{ $product->id }}</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Tên sản phẩm (*):</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Đơn giá (VNĐ) (*):</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="1000" class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Số lượng tồn kho:</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Mô tả sản phẩm:</label>
            <textarea name="description" id="description" rows="4" class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50">Quay lại</a>
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 shadow-sm">Cập nhật thay đổi</button>
        </div>
    </form>
</div>
@endsection