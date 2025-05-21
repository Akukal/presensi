<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAjaran extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'tahun_id',
        'status',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
