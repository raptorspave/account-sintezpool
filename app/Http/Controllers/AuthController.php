<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        $remember = $this->request->input('remember') ? true : false;

        $auth_result = Auth::attempt([
            'email' => $this->request->input('email'),
            'password' => $this->request->input('password'),
        ], $remember);

        if ($auth_result) {
            if (Gate::allows('is.admin'))
                return redirect()->route('voyager.dashboard');

            elseif (Gate::allows('is.status'))
                return redirect()->route('site.home');

            $auth_error = trans('auth.access_denied');
        }
        else $auth_error = trans('auth.wrong_password');

        return redirect()->back()
                    ->withInput($this->request->only('email', 'remember'))
                    ->with('authError', $auth_error);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('site.auth.login');
    }
}
