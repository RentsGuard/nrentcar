<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
        'foto_profil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFotoProfilUrlAttribute()
    {
        return $this->foto_profil
            ? asset('storage/'.$this->foto_profil)
            : null;
    }

    public function mobil(): HasMany
    {
        return $this->hasMany(Mobil::class, 'managed_by');
    }

    public function penyewaan(): HasMany
    {
        return $this->hasMany(Penyewaan::class);
    }

    public function verifiedCustomers(): HasMany
    {
        return $this->hasMany(Customer::class, 'verified_by');
    }

    public function dendaLunasBy(): HasMany
    {
        return $this->hasMany(Pengembalian::class, 'denda_lunas_by');
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeStaff($query)
    {
        return $query->where('role', 'staff');
    }
}
