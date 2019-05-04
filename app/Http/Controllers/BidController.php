<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Product;
use App\Bid;
use App\AdminUserChat;
use DateTime;
use App\Allow;
use App\Notification;

class BidController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function store(Request $request, $id) {
    	$this->validate($request, [
    		'bid' => 'required|numeric'
    	]);

    	$bid = New Bid;
    	$bid->bid = $request->bid;
    	$bid->user_id = Auth::user()->id;
    	$bid->product_id = $id;
    	$bid->save();

    	Session::flash('success', 'nice');

    	return redirect()->back();
    }

    public function tester() {
        $products = Product::where('status', 1)->get();
        $productArr = [];
        $x = 0;
        $now = date("Y-m-d");

        foreach ($products as $row) {
            // $date = new DateTime("09/14/2017");
            if (strtotime($row->duration) < strtotime($now)) {
                // get the highest bid
                $bid = Bid::where('product_id', $row->id)->get();
                // echo $bid->max('bid');
                $max = Bid::where([['product_id', $row->id], ['bid', $bid->max('bid')]])->orderBy('id', 'asc')->get();

                // print_r($max);
                if($max->count() > 0) {
                    foreach ($max as $d) {
                        $productArr[$x++] = [
                            'id' => $row->id,
                            'product_id' => $row->product_id,
                            'user_id' => $row->user_id,
                            'name' => $row->name,
                            'price' => $row->price,
                            'color' => $row->color,
                            'style' => $row->style,
                            'brand' => $row->brand,
                            'series' => $row->series,
                            'denomination' => $row->denomination,
                            'piston' => $row->piston,
                            'cylinder' => $row->cylinder,
                            'fuel' => $row->fuel,
                            'milage' => $row->milage,
                            'year' => $row->year,
                            'duration' => date('M d, Y', strtotime($row->duration)),
                            'duration2' => $row->duration,
                            'status' => $row->status,
                            'created_at' => date('M d, Y', strtotime($row->created_at)),
                            'h_bidder_id' => $d->user_id,
                            'h_bidder' => $d->user->firstname. ' ' .$d->user->middlename. ' ' .$d->user->lastname,
                            'h_bid' => $d->bid
                        ];
                        break;
                    }
                } else {
                    $productArr[$x++] = [
                        'id' => $row->id,
                        'product_id' => $row->product_id,
                        'user_id' => $row->user_id,
                        'name' => $row->name,
                        'price' => $row->price,
                        'color' => $row->color,
                        'style' => $row->style,
                        'brand' => $row->brand,
                        'series' => $row->series,
                        'denomination' => $row->denomination,
                        'piston' => $row->piston,
                        'cylinder' => $row->cylinder,
                        'fuel' => $row->fuel,
                        'milage' => $row->milage,
                        'year' => $row->year,
                        'duration' => date('M d, Y', strtotime($row->duration)),
                        'duration2' => $row->duration,
                        'status' => $row->status,
                        'created_at' => date('M d, Y', strtotime($row->created_at)),
                        'h_bidder_id' => 'none',
                        'h_bidder' => 'none',
                        'h_bid' => 'none'
                    ];
                }
                // -------------------------
            }
        }

        $productArr = json_decode(json_encode($productArr));

        foreach ($productArr as $row) {
            echo $row->h_bidder_id . " $row->id <br>";
            if($row->h_bidder_id != 'none') {
                $usernotif = Notification::where([['user_id', $row->h_bidder_id], ['car_id', $row->id]])->first();
                if ($usernotif === null) {
                   $uNotif = New Notification;
                   $uNotif->user_id = $row->h_bidder_id;
                   $uNotif->car_id = $row->id;
                   $uNotif->status = 0;
                   $uNotif->description = 'You are the highest bidder! ( '. $row->brand. ' ' .$row->name. ' ' .$row->color. ' )';
                   $uNotif->save();
                }

                $allow1 = Allow::where([['user_id', $row->h_bidder_id], ['allow', $row->user_id]])->first();
                $allow2 = Allow::where([['user_id', $row->user_id], ['allow', $row->h_bidder_id]])->first();
                if ($allow1 === null) {
                    $allow_chat = New Allow;
                    $allow_chat->user_id = $row->h_bidder_id;
                    $allow_chat->allow = $row->user_id;
                    $allow_chat->save();
                }

                if ($allow2 === null) {
                    $allow_chat = New Allow;
                    $allow_chat->user_id = $row->user_id;
                    $allow_chat->allow = $row->h_bidder_id;
                    $allow_chat->save();
                }
            }
        }
    }
}
