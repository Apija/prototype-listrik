<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarifs';
    protected $primaryKey = 'id_tarif';

    protected $fillable = [
        'daya',
        'tarif_per_kwh'
    ];

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_tarif');
    }
}
