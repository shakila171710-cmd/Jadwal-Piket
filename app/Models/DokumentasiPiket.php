<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiPiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'tanggal',
        'nama_perwakilan',
        'foto',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}