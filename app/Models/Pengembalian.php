<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> aqsha
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
<<<<<<< HEAD
    use HasFactory;

=======
>>>>>>> aqsha
    protected $table = 'pengembalian';

    protected $fillable = [
        'penyewaan_id',
<<<<<<< HEAD
        'tanggal_kembali_real',
        'telat_jam',
        'denda_per_jam',
        'denda_telat',
        'denda_kerusakan',
        'total_denda',
        'status_pengembalian',
        'catatan',
        'foto_kondisi',
=======
        'tanggal_pengembalian',
        'kondisi_mobil',
        'denda',
        'catatan',
>>>>>>> aqsha
    ];

    protected function casts(): array
    {
        return [
<<<<<<< HEAD
            'tanggal_kembali_real' => 'datetime',
            'telat_jam' => 'integer',
            'denda_per_jam' => 'decimal:2',
            'denda_telat' => 'decimal:2',
            'denda_kerusakan' => 'decimal:2',
            'total_denda' => 'decimal:2',
=======
            'tanggal_pengembalian' => 'date',
            'denda' => 'decimal:2',
>>>>>>> aqsha
        ];
    }

    public function penyewaan(): BelongsTo
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
