<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * membuat tabel order details pesanan
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            // penghubung dengan tabel orders
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            // penghubung dengan tabel event
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->integer('quantity'); // jumlah pesanan
            $table->integer('subtotal'); // jumlah total harga yang harus dibayar oleh customer
            $table->timestamps();
        });
    }

    /**
     * Method down() dijalankan saat `php artisan migrate:rollback`.
     * Menghapus tabel events.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
