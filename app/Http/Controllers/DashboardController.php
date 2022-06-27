<?php

namespace App\Http\Controllers;

use App\Models\BookFee;
use App\Models\BookList;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
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

    public function bukuDashboard() {
        $student = Student::count();
        $sumToday = BookFee::whereDate('tanggal_bayar', Carbon::today())->sum('nominal');
        $sumMonth = BookFee::whereMonth('tanggal_bayar', Carbon::today())->sum('nominal');
        $bookList = BookList::count();
        return view('buku.dashboard', compact('student', 'sumToday', 'sumMonth', 'bookList'));
    }
}
