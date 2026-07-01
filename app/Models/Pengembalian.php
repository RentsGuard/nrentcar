<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'penyewaan_id',
        'user_id',
        'tanggal_pengembalian',
        'kondisi_mobil',
        'telat_jam',
        'denda_per_jam',
        'denda_telat',
        'denda_kerusakan',
        'total_denda',
        'status_pengembalian',
        'status_denda',
        'denda_lunas_at',
        'denda_lunas_by',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengembalian' => 'datetime',
            'telat_jam' => 'integer',
            'denda_per_jam' => 'decimal:2',
            'denda_telat' => 'decimal:2',
            'denda_kerusakan' => 'decimal:2',
            'total_denda' => 'decimal:2',
            'denda_lunas_at' => 'datetime',
        ];
    }

    public function penyewaan(): BelongsTo
    {
        return $this->belongsTo(Penyewaan::class);
    }

    public function dendaLunasBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'denda_lunas_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
