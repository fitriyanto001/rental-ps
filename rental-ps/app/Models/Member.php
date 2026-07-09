<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'name',
        'phone',
        'discount_percentage'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'member_id');
    }
}
