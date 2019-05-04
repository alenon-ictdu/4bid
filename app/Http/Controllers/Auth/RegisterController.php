<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use App\PaymentLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'contact' => 'required|max:191',
            'address' => 'required|max:191',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'paypal' => 'required',
            'type' => 'required|not_in:none'
        ]);
    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    /*protected function create(array $data)
    {
        return User::create([
            'user_type' => 2,
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'contact' => $data['contact'],
            'address' => $data['address'],
            'email' => $data['email'],
            'paypal' => $data['paypal'],
            'type' => $data['type'],
            'password' => bcrypt($data['password']),
        ]);
    }*/


    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
            'lastname' => 'required|string|max:255',
            'contact' => 'required|max:191',
            'address' => 'required|max:191',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|not_in:none'
        ]);

        /*$user =  New User;
        $user->user_type = 2;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $user->save();*/
        $userArr = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'contact' => $request->contact,
            'address' => $request->address,
            'email' => $request->email,
            'type' => $request->type,
            'password' => $request->password
        ];

        return view('auth.paypal')
            ->with('user', $userArr);

        /*return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());*/
    }

    public function store(Request $request) {
        $year = date('y');
        $month = date('m');
        $day = date('d');
        $userID = $year.$month.$day.'00'.rand(1, 10000);
        while (User::where('user_id', $userID)->count() > 0) {
            $userID = $year.$month.$day.'00'.rand(1, 10000);
        }

        $user =  New User;
        $user->user_id = $userID;
        $user->user_type = 2;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $user->save();

        $paymentLog = New PaymentLog;
        $paymentLog->action = 'Registration';
        $paymentLog->description = 'Payment from '. $request->firstname. ' ' .$request->middlename. ' ' .$request->lastname;
        $paymentLog->amount = '1000';
        $paymentLog->save();


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('item.index');
        } 

        return redirect()->route('register');
        // return redirect()->route('item.index');

        /*if (Auth::login($credentials)) {
            return Redirect::to('home');
        }*/

        // return redirect()->route('login');
    }
}
