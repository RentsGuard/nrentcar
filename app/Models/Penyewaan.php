<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';

    protected $fillable = [
        'customer_id',
        'mobil_id',
        'user_id',
        'tanggal_sewa',
        'jam_sewa',
        'tanggal_kembali',
        'jam_kembali',
        'lama_sewa',
        'total_harga',
        'denda_per_jam',
        'status',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_sewa' => 'date',
            'jam_sewa' => 'string',
            'tanggal_kembali' => 'date',
            'jam_kembali' => 'string',
            'lama_sewa' => 'integer',
            'total_harga' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class);
    }
}
