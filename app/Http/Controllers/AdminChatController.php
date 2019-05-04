<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\AdminUserChat;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Inbox;

class AdminChatController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    // admin ----------------------------------------
	public function submitChat() {
    	$admin_id = Input::get("admin_id");
    	$user_id = Input::get("user_id");
    	$msg = Input::get("msg");

    	$chat = New AdminUserChat;
    	$chat->from = $admin_id;
    	$chat->to = $user_id;
    	$chat->message = $msg;
    	$chat->status = 0;
    	$chat->save();
    }

    public function chats($user_id, $admin_id) {
    	$chat1 = AdminUserChat::where([['from', $admin_id], ['to', $user_id]])->orderBy('created_at', 'asc')->get();
    	$chat2 = AdminUserChat::where([['to', $admin_id], ['from', $user_id]])->orderBy('created_at', 'asc')->get();
    	$chats = $chat1->merge($chat2);

	    //ASC
	    $chats = array_values(array_sort($chats, function ($value) {
	      return $value['id'];
	    }));
    	
    	foreach ($chats as $row) {
    		if ($row->from == Auth::user()->id) {
    			echo "<div align='right' style='margin-top:5px; width: 100%;'><small>".$row->created_at->toDayDateTimeString()."</small> <p class='btn btn-rounded btn-primary'>".$row->message."</p></div>";
    		} else {
    			echo "<div style='margin-top:5px; width: 100%;'><p class='btn btn-rounded btn-secondary'>".$row->message."</p> <small>".$row->created_at->toDayDateTimeString()."</small> </div>";
    		}
    	}
    } // admin ----------------------------------------



    // user -------------------------------------------
    public function userViewChat() {
        
        if(Auth::user()->user_type == 1) {
            return redirect()->route('product.index');
        }

        $admin = User::where('user_type', 1)->first();
        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        foreach ($chatniAdmin as $row) {
            $c = AdminUserChat::find($row->id);
            $c->status = 1;
            $c->save();
        }

        return view('member.chat.index')
            ->with('inboxNotif', $inboxNotif)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('pageTitle', 'Chat')
            ->with('admin', $admin);
    }

    public function submitUserChat() {
        $admin_id = Input::get("admin_id");
        $user_id = Input::get("user_id");
        $msg = Input::get("msg");

        $chat = New AdminUserChat;
        $chat->from = $user_id;
        $chat->to = $admin_id;
        $chat->message = $msg;
        $chat->status = 0;
        $chat->save();
    }
}
