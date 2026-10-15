<?php
namespace Database\Seeders;// base seeder 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // facades db untuk query

// isi data minimal 5 data dummy
class EventSeeder extends Seeder {
    public function run(): void {
        DB::table('events')->insert([
            ['title' => 'Konser Dewa 19', 
            'category' => 'Musik', 'ticket_price' => 500000, 
            'description' => 'Konser spesial Dewa 19 di Jakarta.', 
            'image' => null, 
            'created_at' => now(), 
            'updated_at' => now()],

            ['title' => 'Festival Musik Pantai', 
            'category' => 'Festival',
            'ticket_price' => 250000,
            'description' => 'Festival musik di Bali dengan artis lokal.', 'image' => null,
            'created_at' => now(),
            'updated_at' => now()],

            ['title' => 'Seminar Musik Digital', 
            'category' => 'Seminar', 'ticket_price' => 100000, 
            'description' => 'Belajar industri musik digital.', 
            'image' => null, 
            'created_at' => now(), 
            'updated_at' => now()],

            ['title' => 'Allobank Festival 2025', 
            'category' => 'Festival', 'ticket_price' => 700000, 
            'description' => 'Festival tahunan dengan artis top.', 
            'image' => null, 
            'created_at' => now(), 
            'updated_at' => now()],

            ['title' => 'Put Your Phone Down 2026', 
            'category' => 'Musik', 'ticket_price' => 2000000, 
            'description' => 'Konser musik bersama Cortis di JIS.', 
            'image' => null, 
            'created_at' => now(), 
            'updated_at' => now()],
        ]);
    }
}