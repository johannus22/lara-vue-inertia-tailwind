<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Storage;

class AuthController extends Controller
{
    public function register(Request $request){
        // sleep(1);

        // check if file exists
        //validate
        $fields = $request->validate([
            'avatar' => ['file','nullable','max:300'],
            'name' => ['required', 'max:255'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        if($request->hasFile('avatar')){
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }
        //reg
        $user = User::create($fields);
        //auth
        Auth::login($user);

        //redir
        return redirect()->route('dashboard');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
