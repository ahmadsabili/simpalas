<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    public $table = 'spp';
    public $timestamps = false;
    protected $fillable = [
        'tahun_ajaran',
        'kelas',
        'nominal'
    ];

    public function tagihan_spp() {
        return $this->hasMany(PembayaranSpp::class);
    }
}
