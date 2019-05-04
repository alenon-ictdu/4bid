<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Product;
use App\AdminUserChat;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	abort_if(Auth::user()->user_type == 2, 404);

    	$user = new User;
		$onlineUsers = $user->allOnline();

    	$pendingProducts = Product::where('status', 0)->get();
    	$users = User::where('user_type', 2)->get();

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

    	return view('admin.user.index')
    		->with('onlineUsers', $onlineUsers)
            ->with('unseenUserArr', $unseenUserArr)
    		->with('users', $users)
    		->with('pendingProducts', $pendingProducts)
            ->with('pageTitle', 'Admin :: Users');
    }

    public function show($id) {
        abort_if(Auth::user()->user_type == 2, 404);

        $user = new User;
        $onlineUsers = $user->allOnline();

        $pendingProducts = Product::where('status', 0)->get();

        

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

        // make the message status seen
        $uChats = AdminUserChat::where([['from', $id], ['status', 0]])->get();
        foreach ($uChats as $row) {
            $auc = AdminUserChat::find($row->id);
            $auc->status = 1;
            $auc->save();
        }
        // 

        $user = User::find($id);
        $products = Product::where('user_id', $user->id)->get();

        return view('admin.user.show')
            ->with('user', $user)
            ->with('onlineUsers', $onlineUsers)
            ->with('unseenUserArr', $unseenUserArr)
            ->with('pendingProducts', $pendingProducts)
            ->with('products', $products)
            ->with('pageTitle', 'Admin :: User '. $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname);
    }
}
