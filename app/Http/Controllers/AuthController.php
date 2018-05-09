<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
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

        $newUserModel = User::create([
            'role_id' => 2,
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => bcrypt($this->request->input('password')),
        ]);

        if ($newUserModel)
            return redirect()->route('site.auth.login')
                ->with('authSuccess', trans('auth.auth_success'));
        else
            abort(500);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost()
    {
        $user = User::status($this->request->input('email'))->first();

        if (!$user || (!$user->status && $user->role_id != 1))
            return redirect()->back()
                ->withInput($this->request->only('email', 'remember'))
                ->with('authError', trans('auth.access_denied'));

        $remember = $this->request->input('remember') ? true : false;

        $authResult = Auth::attempt([
            'email' => $this->request->input('email'),
            'password' => $this->request->input('password'),
        ], $remember);

        if ($authResult) {
            if (Auth::user()->role_id == 1)
                return redirect()->route('voyager.dashboard');
            elseif (Auth::user()->status)
                return redirect()->route('site.profile');
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
