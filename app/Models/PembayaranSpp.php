<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranSpp extends Model
{
    use HasFactory;
    public $table = 'pembayaran_spp';
    protected $fillable = [
        'id_siswa',
        'tahun_ajaran',
        'bulan',
        'nominal'
    ];

    public function siswa() {
        return $this->belongsTo(Student::class, 'id_siswa', 'id');
    }

    public function spp() {
        return $this->belongsTo(Student::class, 'id_spp', 'id');
    }
}
