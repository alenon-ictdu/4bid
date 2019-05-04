<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\AdminUserChat;
use App\Inbox;
use App\User;
use App\Product;
use Auth;

class NotificationController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	$uNotification = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

    	$uNotificationArr = [];
        $w = 0;

        foreach ($uNotification as $row) {
            $car = Product::find($row->car_id);
            $owner = User::find($car->user_id);
            $uNotificationArr[$w++] = [
                'id' => $row->id,
                'user_id' => $row->user_id,
                'car_id' => $row->car_id,
                'description' => $row->description,
                'status' => $row->status,
                'owner' => $owner->firstname. ' ' .$owner->middlename. ' ' .$owner->lastname,
                'owner_id' => $owner->user_id,
                'owner_index' => $owner->id,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at
            ];
        }

        $uNotification = json_decode(json_encode($uNotificationArr));


        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();
        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        // get finished car notif
        $finishedCar = Product::where([['user_id', Auth::user()->id], ['status', 1]])->orderBy('updated_at', 'desc')->get();
        $t = date('Y-m-d');

        return view('member.notification.index')
            ->with('pageTitle', 'Your Notifications')
            ->with('t', $t)
            ->with('finishedCar', $finishedCar)
        	->with('chatniAdmin', $chatniAdmin)
            ->with('inboxNotif', $inboxNotif)
        	->with('uNotification', $uNotification);
    }

    public function update($id) {
        
        $notification = Notification::find($id);
        $notification->status = 1;
        $notification->save();
        return response()->json(['success' => 'Notification has been updated.']);
       
    }

    public function update2($id) {
        
        $product = Product::where('product_id', $id)->first();
        $product->status2 = 1;
        $product->save();
        return response()->json(['success' => 'Notification has been updated.']);
       
    }
}
