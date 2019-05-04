<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\AdminUserChat;
use App\User;
use App\Product;
use App\PaymentLog;

class PaymentController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	abort_if(Auth::user()->user_type == 2, 404);

    	// get unread chats from users
        $usersChat = AdminUserChat::where([['from', '!=', Auth::user()->id], ['status', 0]])->get();
        $unseenUserChat = [];
        $unseenUserArr = [];
        $i = 0;
        foreach ($usersChat as $row) {
            if (!in_array($row->from, $unseenUserChat)) {
                array_push($unseenUserChat, $row->from);
            }
        }

        // print_r($unseenUserChat);
        foreach ($unseenUserChat as $key => $value) {
            $user = User::find($value);
            // echo $value;
            $unseenUserArr[$i++] = [
                'id' => $user->id,
                'name' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
                'image' => $user->image
            ];
        }

        // print_r($unseenUserArr);
        $unseenUserArr = json_decode(json_encode($unseenUserArr));
        // --------------------

        $user = new User;
        $onlineUsers = $user->allOnline();
    	$pendingProducts = Product::where('status', 0)->get();

    	$today = date("Y-m-d");

    	// payments
    	$payments = PaymentLog::orderBy('created_at', 'desc')->get();
    	$money = 0;
    	foreach ($payments as $payment) {
    		$money = $money + $payment->amount;
    	}

    	return view('admin.payment.index')
            ->with('money', $money)
            ->with('payments', $payments)
            ->with('today', $today)
            ->with('unseenUserArr', $unseenUserArr)
            ->with('onlineUsers', $onlineUsers)
        	->with('pendingProducts', $pendingProducts)
        	->with('pageTitle', 'Admin :: Payments');
    }
}
