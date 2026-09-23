@extends('layouts.app')
@section('title', 'Chi tiết: ' . $product->name)
@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl border border-gray-200 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-gray-200 gap-4">
        <div>
            <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider bg-indigo-50 px-2.5 py-1 rounded">Mã SP: #{{ $product->id }}</span>
            <h1 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $product->name }}</h1>
        </div>
        <div class="text-left sm:text-right">
            <div class="text-xs text-gray-500 uppercase font-semibold">Đơn giá niêm yết</div>
            <div class="text-3xl font-black text-indigo-600 mt-0.5">{{ number_format($product->price, 0, ',', '.') }} đ</div>
        </div>
    </div>
    
    <div class="p-4 bg-gray-50 rounded-lg grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
        <div>
            <div class="text-xs font-semibold text-gray-500 uppercase">Tình trạng tồn kho</div>
            <div class="text-base font-bold mt-1">
                @if($product->stock > 0)
                <span class="text-green-700">Còn hàng ({{ $product->stock }} sản phẩm)</span>
                @else
                <span class="text-red-600">Tạm hết hàng</span>
                @endif
            </div>
        </div>
        <div>
            <div class="text-xs font-semibold text-gray-500 uppercase">Thời điểm cập nhật</div>
            <div class="text-base font-bold text-gray-800 mt-1">{{ $product->updated_at ? $product->updated_at->format('d/m/Y H:i') : 'N/A' }}</div>
        </div>
    </div>
    
    <div class="mb-8">
        <h3 class="text-sm font-bold text-gray-700 uppercase mb-2">Mô tả sản phẩm:</h3>
        <div class="p-4 bg-gray-50 rounded-lg text-sm text-gray-700 leading-relaxed">
            {{ $product->description ? $product->description : 'Chưa có thông tin mô tả chi tiết cho sản phẩm này.' }}
        </div>
    </div>
    
    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
        <a href="{{ route('products.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Quay lại danh sách</a>
        
        {{-- CHỈ ADMIN MỚI THẤY NÚT SỬA VÀ XÓA TẠI TRANG CHI TIẾT --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="flex items-center gap-3">
            <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-amber-500 text-white text-sm font-semibold rounded-lg hover:bg-amber-600">Sửa thông tin</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700">Xóa sản phẩm</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection