<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';

    protected $fillable = [
        'nama_mobil',
        'plat_mobil',
        'tahun_mobil',
        'tipe_mobil',
        'kapasitas_mobil',
        'harga_mobil',
        'foto_mobil',
        'bahan_bakar',
        'status_mobil',
        'managed_by',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'tahun_mobil' => 'integer',
            'kapasitas_mobil' => 'integer',
            'harga_mobil' => 'decimal:2',
            'is_visible' => 'boolean',
        ];
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'managed_by');
    }

    public function penyewaan(): HasMany
    {
        return $this->hasMany(Penyewaan::class);
    }
}
