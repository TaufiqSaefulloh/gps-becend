<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uid extends Model
{
    use HasFactory;

    protected $table = 'uid';

    protected $fillable = [
        'nama_uid',
        'id_cluster',
    ];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'id_cluster');
    }
    public function provinsis()
    {
        return $this->hasMany(\App\Models\Provinsi::class, 'id_uid');
    }
}
