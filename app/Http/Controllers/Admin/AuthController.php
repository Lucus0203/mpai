<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    //
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';
    protected $guard = 'web';
    protected $loginView = 'auth.login';
    protected $registerView = 'auth.register';
    protected $username = 'username';

    public function __construct()
    {

    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'username' => 'required|max:255|unique:pai_admin',
            'password' => 'required|confirmed|min:6',
        ]);

    }

    protected function create(array $data)
    {
        return Admin::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);

    }
}
