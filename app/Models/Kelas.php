<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'id',
        'kelas',
        'walas',
        'no_walas'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
