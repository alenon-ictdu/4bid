<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\User;
use Auth;
use App\AdminUserChat;
use App\Product;

class ReportController extends Controller
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


    	// get report
    	$users = User::where('user_type', 2)->get();
    	$reportedUser = [];
    	$ru = 0;

    	foreach ($users as $row) {
    		$numReport = Report::where('reported', $row->id)->get();
    		$reportedUser[$ru++] = [
    			'id' => $row->id,
    			'user_id' => $row->user_id,
    			'name' => $row->firstname. ' ' .$row->middlename. ' ' .$row->lastname,
    			'email' => $row->email,
    			'num_of_report' => $numReport->count()
    		];
    	}

    	$reportedUser = json_decode(json_encode($reportedUser));

    	return view('admin.report.index')
            ->with('reportedUser', $reportedUser)
            ->with('today', $today)
            ->with('unseenUserArr', $unseenUserArr)
            ->with('onlineUsers', $onlineUsers)
        	->with('pendingProducts', $pendingProducts)
        	->with('pageTitle', 'Admin :: Reported User');;
    }
}
