<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookFee extends Model
{
    use HasFactory;

    public $table = 'pembayaran_buku';

    protected $fillable = [
        'id_siswa',
        'kelas',
        'id_buku',
        'nominal',
        'status',
        'tanggal_bayar'
    ];

    public $timestamps = false;

    public function siswa() {
        return $this->belongsTo(Student::class, 'id_siswa', 'id');
    }

    public function buku() {
        return $this->belongsTo(BookList::class, 'id_buku', 'id');
    }
}
