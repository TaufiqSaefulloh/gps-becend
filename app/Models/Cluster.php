<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $table = 'cluster';

    protected $fillable = [
        'nama_cluster',
    ];

    public function uids()
    {
        return $this->hasMany(Uid::class, 'id_cluster');
    }
} 