<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'username',
        'password',
        'nomor_kwh',
        'nama_pelanggan',
        'alamat',
        'id_tarif'
    ];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan');
    }
}
