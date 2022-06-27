<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->role == 'admin') {
            return redirect(route('admin.index'));
        }
        elseif(auth()->user()->role == 'spp'){
            return redirect(route('spp.index'));
        }
        elseif(auth()->user()->role == 'buku'){
            return redirect(route('buku.index'));
        }
        else{
            return auth()->logout();
        }
    }
}