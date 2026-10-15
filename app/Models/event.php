<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    
    use HasFactory;

    protected $table = 'events'; //tabel database yg diwakili model
    protected $guarded = ['id']; //semua kolom boleh diisi kecuali 'id'
    public function orderDetails() {
        //relasinya one to many, event punya banyak orderdetail
        return $this->hasMany(OrderDetail::class, 'event_id');
    }
}