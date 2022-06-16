<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard() {
        $student = Student::count();
        $class = Kelas::count();
        $user = User::count();
        $laki_laki = Student::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Student::where('jenis_kelamin', 'Perempuan')->count();
        return view('admin.dashboard', compact('student', 'class', 'user', 'laki_laki', 'perempuan'));
    }
}
