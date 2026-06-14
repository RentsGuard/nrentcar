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
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kota_kabupaten',
        'provinsi',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'berlaku_hingga',
        'foto_ktp',
        'status_verifikasi',
        'verified_by',
        'tanggal_verifikasi',
        'catatan_verifikasi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berlaku_hingga' => 'date',
        'tanggal_verifikasi' => 'datetime',
    ];

    public function getFotoKtpUrlAttribute()
    {
        return $this->foto_ktp
            ? asset('storage/'.$this->foto_ktp)
            : null;
    }

    public function penyewaan(): HasMany
    {
        return $this->hasMany(Penyewaan::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
