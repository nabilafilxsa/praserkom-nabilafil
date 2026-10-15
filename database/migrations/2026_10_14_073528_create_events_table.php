<?php

use Illuminate\Database\Migrations\Migration; // base migration
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // facade schema

return new class extends Migration
{
    /**
     * membuat tabel event
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //masukkan nama acara
            $table->enum('category', ['Musik', 'Festival', 'Seminar']); // 3 kategori acara
            $table->integer('ticket_price'); // harga 
            $table->text('description'); //deskripsi dari acara
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

   /**
     * Method down() dijalankan saat `php artisan migrate:rollback`.
     * Menghapus tabel events.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
