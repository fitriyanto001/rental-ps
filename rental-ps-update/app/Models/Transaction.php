<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'console_id',
        'member_id',
        'shift_id',
        'kasir_name',
        'renter_name',
        'duration',
        'total_price',
        'status',
        'total_rental',
        'total_kantin',
        'diskon',
        'grand_total'
    ];

    public function transactionFoods()
    {
        return $this->hasMany(TransactionFood::class, 'transaction_id');
    }

    public function console()
    {
        return $this->belongsTo(Console::class, 'console_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}