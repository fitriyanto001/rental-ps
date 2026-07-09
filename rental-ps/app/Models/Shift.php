<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    protected $fillable = [
        'kasir_name',
        'jam_buka',
        'jam_tutup',
        'status',
        'total_transaksi',
        'total_rental',
        'total_kantin',
        'total_diskon',
        'grand_total',
        'catatan_handover',
    ];

    protected $casts = [
        'jam_buka'  => 'datetime',
        'jam_tutup' => 'datetime',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'shift_id');
    }

    /**
     * Ambil shift yang sedang aktif (status = 'buka'), atau null.
     */
    public static function aktif()
    {
        return static::where('status', 'buka')->latest()->first();
    }
}
