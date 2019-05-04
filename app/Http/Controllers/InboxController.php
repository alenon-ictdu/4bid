<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Allow;
use App\Inbox;
use App\Product;
use App\AdminUserChat;

class InboxController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
        abort_if(Auth::user()->user_type == 1, 404);

        $inbox = Inbox::where('user_id', Auth::user()->id)->get();
        $inboxArr = [];
        $s = 0;
        foreach ($inbox as $row) {
            $user = User::find($row->from);
            $inboxArr[$s++] = [
                'id' => $row->id,
                'from' => $row->from,
                'from_name' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
                'subject' => $row->subject,
                'message' => $row->message,
                'created_at' => date('M d, Y h:i:s A', strtotime($row->created_at)),
                'status' => $row->status
            ];
        }

        $inboxArr = json_decode(json_encode($inboxArr));

        $sentMessages = Inbox::where('from', Auth::user()->id)->get();
        
        $deletedMessages = Inbox::where([['from', Auth::user()->id], ['deleted', '!=', null]])->get();

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();


        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();


        return view('member.inbox.index')
            ->with('chatniAdmin', $chatniAdmin)
            ->with('inbox', $inbox)
            ->with('inboxNotif', $inboxNotif)
            ->with('inboxArr', $inboxArr)
            ->with('sentMessages', $sentMessages)
            ->with('deletedMessages', $deletedMessages)
            ->with('pageTitle', 'Inbox');
    }

    public function sent() {
        abort_if(Auth::user()->user_type == 1, 404);

        $inbox = Inbox::where('user_id', Auth::user()->id)->get();
        $inboxArr = [];
        $s = 0;
        foreach ($inbox as $row) {
            $user = User::find($row->from);
            $inboxArr[$s++] = [
                'id' => $row->id,
                'from' => $row->from,
                'from_name' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
                'subject' => $row->subject,
                'message' => $row->message,
                'created_at' => date('M d, Y h:i:s A', strtotime($row->created_at)),
                'status' => $row->status
            ];
        }

        $inboxArr = json_decode(json_encode($inboxArr));

        $sentMessages = Inbox::where('from', Auth::user()->id)->get();
        
        $deletedMessages = Inbox::where([['from', Auth::user()->id], ['deleted', '!=', null]])->get();

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();


        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();


        return view('member.inbox.sent')
            ->with('chatniAdmin', $chatniAdmin)
            ->with('inbox', $inbox)
            ->with('inboxNotif', $inboxNotif)
            ->with('inboxArr', $inboxArr)
            ->with('sentMessages', $sentMessages)
            ->with('deletedMessages', $deletedMessages)
            ->with('pageTitle', 'Inbox');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'highestbidder' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $inbox = New Inbox;
        $inbox->from = Auth::user()->id;
        $inbox->user_id = $request->highestbidder;
        $inbox->subject = $request->subject;
        $inbox->message = $request->message;
        $inbox->status = 0;
        $inbox->save();

        Session::flash('success', 'Message sent.');

        return redirect()->back();
    }

    public function view(Request $request) {
        if($request->ajax()) {
            $inbox = Inbox::find($request->id);
            /*$inbox->status = 1;
            $inbox->save();*/

            return response()->json($inbox);
        }
    }

    public function update($id) {
        
            $inbox = Inbox::find($id);
            $inbox->status = 1;
            $inbox->save();
            return response()->json(['success' => 'Inbox has been updated.']);
       
    }

    public function compose() {
        $allow = Allow::where('user_id', Auth::user()->id)->get();
        $allowArr = [];
        $a = 0;

        foreach ($allow as $row) {
            $user = User::find($row->allow);
            $allowArr[$a++] = [
                'id' => $row->id,
                'user_id' => $row->user_id,
                'allow' => $row->allow,
                'a_name' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
                'a_id' => $user->user_id
            ];
        }

        $allow = json_decode(json_encode($allowArr));

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        return view('member.inbox.compose')
            ->with('pageTitle', 'Inbox :: Compose')
            ->with('allow', $allow)
            ->with('inboxNotif', $inboxNotif)
            ->with('chatniAdmin', $chatniAdmin);
    }

    public function store2(Request $request) {
        $this->validate($request, [
            'user' => 'required|not_in:none',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $inbox = New Inbox;
        $inbox->from = Auth::user()->id;
        $inbox->user_id = $request->user;
        $inbox->subject = $request->subject;
        $inbox->message = $request->message;
        $inbox->status = 0;
        $inbox->save();

        Session::flash('success', 'Message sent.');

        return redirect()->back();
    }
}
