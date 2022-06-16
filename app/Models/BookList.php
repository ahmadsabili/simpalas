<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    use HasFactory;

    public $table = 'buku';

    protected $fillable = [
        'judul',
        'kelas',
        'harga'
    ];

    public function tagihan_buku() {
        return $this->hasMany(BookFee::class);
    }
}
