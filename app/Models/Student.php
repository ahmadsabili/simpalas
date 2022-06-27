<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $table = 'siswa';
    protected $fillable = [
        'nisn',
        'nama',
        'kelas_id',
        'jenis_kelamin',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function tagihan_spp() {
        return $this->hasMany(PembayaranSpp::class);
    }

    public function tagihan_buku() {
        return $this->hasMany(BookFee::class);
    }
}
