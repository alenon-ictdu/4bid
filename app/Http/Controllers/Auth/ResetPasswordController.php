<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use DB;
use Hash;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        // echo 're';
        $dbTokens = DB::table('password_resets')->get();
        $email = '';

        // echo bcrypt($token) . "<br>";

        // print_r($dbTokens);
        foreach($dbTokens as $dbToken) {
            if (Hash::check($token, $dbToken->token)) {
                $email = $dbToken->email;
                break;
            }
        }


        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }
}
