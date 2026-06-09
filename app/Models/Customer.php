<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_customer',
        'email',
        'no_hp',
        'alamat_customer',
        'nik',
    ];

    public function penyewaan(): HasMany
    {
        return $this->hasMany(Penyewaan::class);
    }

    public function verifikasi(): HasMany
    {
        return $this->hasMany(Verifikasi::class);
    }
}
