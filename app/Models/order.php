<?php

namespace App\Models; //base models

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    use HasFactory;

    protected $guarded = ['id']; // semua kolom boleh diisi dengan massal kecuali id

    public function orderDetails() {
       /**
     * Relasi One-to-Many: 1 Order punya banyak OrderDetail.
     */
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}