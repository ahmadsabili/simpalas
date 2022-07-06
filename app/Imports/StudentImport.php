<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    private $classes;
    public function __construct()
    {
        $this->classes = Kelas::select('id', 'nama_kelas')->get();
    }


    public function model(array $row)
    {
        $class = $this->classes->where('nama_kelas', $row['kelas'])->first();
        return new Student([
            'nisn' => $row['nisn'],
            'nama' => $row['nama'],
            'kelas_id' => $class->id ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'],
        ]);
    }
}
