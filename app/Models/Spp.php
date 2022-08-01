<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
