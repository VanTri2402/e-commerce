@extends('layouts.app')
@section('title', 'Danh sách sản phẩm')
@section('content')
<!-- Breadcrumb Navigation -->
<nav class="breadcrumb mb-4 text-sm text-gray-500" aria-label="Đường dẫn trang">
    <a href="{{ route('products.index') }}" class="hover:underline text-indigo-600">Hệ thống</a>
    <span class="mx-2">/</span>
    <span class="text-gray-700 font-medium">Sản phẩm</span>
</nav>

<!-- Page Header & Action CTA -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Quản lý Danh mục Sản phẩm</h1>
        <p class="text-sm text-gray-500 mt-1">Theo dõi trạng thái tồn kho, định giá và quản trị danh mục sản phẩm trực quan.</p>
    </div>
    {{-- ĐIỀU KIỆN PHÂN QUYỀN: CHỈ HIỂN THỊ NÚT THÊM NẾU LÀ ADMIN --}}
    @if(auth()->check() && auth()->user()->role === 'admin')
    <div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Thêm sản phẩm mới</span>
        </a>
    </div>
    @endif
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
        <div>
            <div class="text-xs font-semibold text-gray-500 uppercase">Tổng sản phẩm</div>
            <div class="text-2xl font-extrabold text-gray-900 mt-1">{{ $products->count() }}</div>
        </div>
        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="20" height="14" x="2" y="5" rx="2" stroke-width="2"/><line x1="2" y1="10" x2="22" y2="10" stroke-width="2"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
        <div>
            <div class="text-xs font-semibold text-gray-500 uppercase">Đang còn hàng</div>
            <div class="text-2xl font-extrabold text-green-600 mt-1">{{ $products->where('stock', '>', 0)->count() }}</div>
        </div>
        <div class="p-3 bg-green-50 text-green-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
        <div>
            <div class="text-xs font-semibold text-gray-500 uppercase">Hết hàng tồn</div>
            <div class="text-2xl font-extrabold text-red-600 mt-1">{{ $products->where('stock', '<=', 0)->count() }}</div>
        </div>
        <div class="p-3 bg-red-50 text-red-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><line x1="12" y1="8" x2="12" y2="12" stroke-width="2"/><line x1="12" y1="16" x2="12.01" y2="16" stroke-width="2"/></svg>
        </div>
    </div>
</div>

<!-- Data Table Card -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-lg font-bold text-gray-900">Bảng dữ liệu sản phẩm</h2>
        <div class="w-full sm:w-72">
            <input type="search" id="search-input" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tìm kiếm theo tên sản phẩm...">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="products-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên sản phẩm</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Đơn giá</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tồn kho</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="product-row hover:bg-gray-50 transition" data-name="{{ strtolower($product->name) }}">
                    <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-gray-500">#{{ $product->id }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('products.show', $product->id) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">{{ $product->name }}</a>
                        @if($product->description)
                        <div class="text-xs text-gray-500 mt-0.5 truncate max-w-xs">{{ Str::limit($product->description, 60) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ number_format($product->price, 0, ',', '.') }} đ</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->stock > 0)
                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Còn hàng ({{ $product->stock }})</span>
                        @else
                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Hết hàng (0)</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="inline-flex items-center gap-2">
                            <a href="{{ route('products.show', $product->id) }}" class="text-gray-600 hover:text-gray-900 bg-gray-100 px-2.5 py-1 rounded text-xs font-medium">Xem</a>
                            {{-- CHỈ ADMIN MỚI THẤY NÚT SỬA VÀ XÓA --}}
                            @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('products.edit', $product->id) }}" class="text-amber-700 hover:text-amber-900 bg-amber-50 px-2.5 py-1 rounded text-xs font-medium border border-amber-200">Sửa</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:text-red-900 bg-red-50 px-2.5 py-1 rounded text-xs font-medium border border-red-200">Xóa</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">Chưa có sản phẩm nào trong cơ sở dữ liệu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Lọc dữ liệu tức thì theo tên sản phẩm
    document.getElementById('search-input')?.addEventListener('input', function (e) {
        const keyword = e.target.value.toLowerCase().trim();
        document.querySelectorAll('.product-row').forEach(row => {
            const name = row.getAttribute('data-name') || '';
            row.style.display = name.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endpush