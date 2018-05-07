<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register', [
            'title' => 'Регистрация',
        ]);
    }

    public function registerPost()
    {
        $this->validate($this->request, [
            'name' => 'required|max:255',
            'email' => 'required|regex:/.+@.+\..+/i|unique:users|max:255',
            'password' => 'required|max:255|min:6',
            'password2' => 'required|same:password',
            'is_confirmed' => 'accepted'
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => bcrypt($this->request->input('password')),
            'created_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('site.auth.login');
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'Вход в систему',
        ]);
    }

    public function loginPost()
    {
        $remember = $this->request->input('remember') ? true : false;

        $authResult = Auth::attempt([
            'email' => $this->request->input('email'),
            'password' => $this->request->input('password'),
        ], $remember);

        if ($authResult) {
            if (Auth::user()->role_id == 1)
                return redirect()->route('voyager.dashboard');
            elseif (Auth::user()->status == 1)
                return redirect()->route('site.profile');
            else abort(403, 'Unauthorized action.');
        } else {
            return redirect()->back()
                ->withInput($this->request->only('email', 'remember'))
                ->with('authError', trans('auth.wrong_password'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('site.auth.login');
    }
}
