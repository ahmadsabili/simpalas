<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    public $table = 'komite';
    public $timestamps = false;
    protected $fillable = [
        'tahun_ajaran',
        'kelas',
        'nominal'
    ];
}
