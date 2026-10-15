<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {

    use HasFactory;

    protected $table = 'order_details'; //tabel yang diwakili
    protected $guarded = ['id']; // semua bisa diisi kecuali id

    public function event() {
        /**
     * Relasi BelongsTo: 1 OrderDetail milik 1 Event.
     * Dipakai untuk akses judul/harga event dari tiap detail pesanan.
     */
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function order() {
        // relasi belongsTo: 1 orders milik 1 order
        return $this->belongsTo(Order::class, 'order_id');
    }
}