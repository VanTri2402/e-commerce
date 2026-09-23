<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('name'); // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả chi tiết, cho phép bỏ trống (null)
            $table->decimal('price', 15, 2); // Đơn giá bán (giữ độ chính xác tiền tệ)
            $table->integer('stock')->default(0); // Số lượng tồn kho (mặc định bằng 0)
            $table->timestamps(); // Tự động tạo 2 cột created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};