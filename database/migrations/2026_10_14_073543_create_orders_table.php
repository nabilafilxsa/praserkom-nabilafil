<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * membuat tabel orders (transaksi pesanan)
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // masukkan nama customer
            $table->string('customer_email'); // masukkan email customer
            $table->integer('total_price'); // total harga yang harus dibayar oleh customer
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); //status pesanan 
            $table->timestamps();
        });
    }

    /**
     * Method down() dijalankan saat `php artisan migrate:rollback`.
     * Menghapus tabel events.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
