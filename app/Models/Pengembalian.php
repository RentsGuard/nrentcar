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
        'tanggal_kembali',
        'telat_jam',
        'denda_per_jam',
        'denda_telat',
        'denda_kerusakan',
        'total_denda',
        'status_pengembalian',
        'catatan',
        'foto_kondisi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kembali' => 'datetime',
            'telat_jam' => 'integer',
            'denda_per_jam' => 'decimal:2',
            'denda_telat' => 'decimal:2',
            'denda_kerusakan' => 'decimal:2',
            'total_denda' => 'decimal:2',
        ];
    }

    public function penyewaan(): BelongsTo
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
