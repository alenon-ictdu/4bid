<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Product;
use App\Inbox;
use App\AdminUserChat;
use Session;
use Image;
use File;
use Hash;

class UserAccountController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function show() {
    	// for members 
    	if (Auth::user()->user_type == 2) {
    		// get inbox notif
	 		$inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();


	    	$chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();
	    	return view('account.information')
	    		->with('pageTitle', 'Account')
	    		->with('inboxNotif', $inboxNotif)
	    		->with('chatniAdmin', $chatniAdmin);
    	}

    	// for admin
    	if (Auth::user()->user_type == 1) {
    		$pendingProducts = Product::where('status', 0)->get();
    		$user = new User;
    		$onlineUsers = $user->allOnline();
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

	    	return view('account.information')
	    		->with('onlineUsers', $onlineUsers)
	    		->with('pendingProducts', $pendingProducts)
	    		->with('unseenUserArr', $unseenUserArr)
	    		->with('pageTitle', 'Account');
    	}
    }

    public function update(Request $request) {
	    if (Auth::user()->user_type == 2) {
	    	if(Auth::user()->email == $request->email) {
	    		$this->validate($request, [
		            'firstname' => 'required|string|max:255',
		            'middlename' => 'string|max:255',
		            'lastname' => 'required|string|max:255',
		            'contact' => 'required|max:191',
		            'address' => 'required|max:191',
		            'type' => 'required|not_in:none',
		        ]);
	    	} else {
		    	$this->validate($request, [
		            'firstname' => 'required|string|max:255',
		            'middlename' => 'string|max:255',
		            'lastname' => 'required|string|max:255',
		            'contact' => 'required|max:191',
		            'address' => 'required|max:191',
		            'email' => 'required|string|email|max:255|unique:users',
		            'type' => 'required|not_in:none',
		        ]);
		    }
	    } else {
	    	if(Auth::user()->email == $request->email) {
	    		$this->validate($request, [
		            'firstname' => 'required|string|max:255',
		            'middlename' => 'string|max:255',
		            'lastname' => 'required|string|max:255',
		            'contact' => 'required|max:191',
		            'address' => 'required|max:191'
		        ]);
	    	} else {
		    	$this->validate($request, [
		            'firstname' => 'required|string|max:255',
		            'middlename' => 'string|max:255',
		            'lastname' => 'required|string|max:255',
		            'contact' => 'required|max:191',
		            'address' => 'required|max:191',
		            'email' => 'required|string|email|max:255|unique:users'
		        ]);
		    }
	    }

	    $user = User::find(Auth::user()->id);
	    $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->type = $request->type;
        

        // save product images
        if ($request->hasFile('image')) {

            $allowedfileExtension = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'];
            $photo = $request->file('image');

            $photoName = $photo->getClientOriginalName();
            $photoName = str_replace(' ', '', $photoName);
            $extension = $photo->getClientOriginalExtension();
            $photoName = str_replace('.'.$extension, '', $photoName);
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $filename = $photoName.time() . '.' . $photo->getClientOriginalExtension();
                $location = public_path('uploads/user/' . $filename);
                // Image::make($photo)->resize(800, 400)->save($location);
                Image::make($photo)->save($location);

                $user->image = $filename;
            }

        }

        $user->save();

        Session::flash('success', 'Account information has been updated.');

        return redirect()->back();

    }

    public function password() {
    	// for members 
    	if (Auth::user()->user_type == 2) {
    		// get inbox notif
	 		$inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();


	    	$chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();
	    	return view('account.password')
	    		->with('pageTitle', 'Account')
	    		->with('inboxNotif', $inboxNotif)
	    		->with('chatniAdmin', $chatniAdmin);
    	}

    	// for admin
    	if (Auth::user()->user_type == 1) {
    		$pendingProducts = Product::where('status', 0)->get();
    		$user = new User;
    		$onlineUsers = $user->allOnline();
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

	    	return view('account.password')
	    		->with('onlineUsers', $onlineUsers)
	    		->with('pendingProducts', $pendingProducts)
	    		->with('unseenUserArr', $unseenUserArr)
	    		->with('pageTitle', 'Account');
    	}
    }

    public function updatePassword(Request $request) {
    	if (Hash::check($request->oldpassword, Auth::user()->password)) {
            if ($request->newpassword != $request->newpasswordconfirmation) {
                Session::flash('error', 'New password and confirmation password does not match.');
                return redirect()->back();
            } else {
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt($request->newpassword);
                $user->save();

                // show a success message
                Session::flash('success', 'Password has been changed.');

                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Old password does not match');
            return redirect()->back();
        }
    }
}
