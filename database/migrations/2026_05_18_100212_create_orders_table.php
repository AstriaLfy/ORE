<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order'); // Primary key
            $table->unsignedBigInteger('user_id'); // Referensi ke User Service
            $table->unsignedBigInteger('product_id'); // Referensi ke Product Service
            $table->dateTime('tanggal');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();

            // Catatan: Jika database-nya menyatu (Monolithic), kamu bisa uncomment foreign key di bawah ini.
            // Jika benar-benar terpisah beda database (Microservices murni), foreign key ditiadakan dan ditangani via API.
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('product_id')->references('id_product')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};