<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulp extends Model
{
    use HasFactory;

    protected $table = 'ulp';

    protected $fillable = [
        'nama_ulp',
        'id_provinsi',
    ];
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'id_ulp');
    }
}
