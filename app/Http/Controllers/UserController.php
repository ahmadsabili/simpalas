<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class UserController extends Controller
{
    public function index() {
        $users = User::select('id','name', 'email', 'role')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        if(User::where('email', $request->email)->exists()) {
            return redirect()->route('users.create')->with('error','Email sudah terdaftar !');
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('users.index')->with('success','User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success','User berhasil dihapus!');
    }
}
