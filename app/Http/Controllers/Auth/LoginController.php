<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session()->flash('message', 'Uspješno ste se prijavili.');
            return redirect()->intended(url('/managment'));
        } else {
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Pogrešna e-mail adresa ili lozinka.');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        session()->flash('message', 'Uspješno ste se odjavili.');
        return redirect('/');
    }
}
