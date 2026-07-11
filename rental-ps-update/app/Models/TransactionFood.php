<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionFood extends Model
{
    protected $table = 'transaction_food';

    protected $fillable = [
        'transaction_id',
        'menu_kantin_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function menuKantin()
    {
        return $this->belongsTo(MenuKantin::class, 'menu_kantin_id');
    }
}
