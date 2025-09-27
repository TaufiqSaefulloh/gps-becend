<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';

    protected $fillable = [
        'nama_provinsi',
        'id_uid',
    ];

    public function uid()
    {
        return $this->belongsTo(Uid::class, 'id_uid');
    }
    protected static function booted()
    {
        static::addGlobalScope('pic', function ($builder) {
            $user = auth()->user();
            if ($user && $user->role === 'pic') {
                $builder->where('id_uid', $user->id_uid);
            }
        });
    }
}
