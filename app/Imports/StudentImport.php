<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'nisn' => $row[0],
            'nama' => $row[1],
            'kelas' => $row[2],
            'jenis_kelamin' => $row[3],
            'alamat' => $row[4],
            'tahun_ajaran' => $row[5]
        ]);
    }
}
