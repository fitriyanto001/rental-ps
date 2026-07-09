<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    protected $table = 'consoles';

    protected $fillable = [
        'name',
        'type',
        'status'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'console_id');
    }
}
