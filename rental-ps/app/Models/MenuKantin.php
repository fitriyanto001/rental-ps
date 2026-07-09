<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuKantin extends Model
{
    // Laragon database table name
    protected $table = 'menu_kantin';

    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'stok',
        'status'
    ];

    public function transactionFoods()
    {
        return $this->hasMany(TransactionFood::class, 'menu_kantin_id');
    }
}
