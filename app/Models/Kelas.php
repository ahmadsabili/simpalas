<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Kelas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nama_kelas'
    ];

    public function student() {
        return $this->hasMany(Student::class);
    }
}
