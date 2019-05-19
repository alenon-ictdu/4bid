<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Bid;
use App\Product;
use App\ProductImage;
use App\AdminUserChat;
use App\Inbox;
use App\Report;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 1) {
            return redirect()->route('payment.index');
        }

        // consider created_at is the field you want to query on the model called News
        $date = new Carbon; //  DateTime string will be 2014-04-03 13:57:34

        $date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25

        // get 7 days old
        $products = Product::where([['created_at', '>', $date->toDateTimeString() ], ['status', 1]])->get();
        $productArr = [];
        $x = 0;
        $highest = 0;
        foreach ($products as $row) {
            $productImages = ProductImage::where('product_id', $row->id)->get();
            foreach ($productImages as $productImage) {
                if ($highest < $productImage->id) {
                    $highest = $productImage->id;
                }
            }
            $thumbnail = ProductImage::find($highest);

            /*$productArr[$x++] = [
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
                'thumbnail' => $thumbnail->image,
                'created_at' => date('M d, Y', strtotime($row->created_at))
            ];*/

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
                        'thumbnail' => empty($thumbnail) == true ? '':$thumbnail->image,
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
                    'thumbnail' => empty($thumbnail) == true ? '':$thumbnail->image,
                    'created_at' => date('M d, Y', strtotime($row->created_at)),
                    'h_bidder_id' => 'none',
                    'h_bidder' => 'none',
                    'h_bid' => 'none'
                ];
            }
            // -------------------------

            // reset highest
            $highest = 0;
        }

        $products = json_decode(json_encode($productArr));
        // endddddddd

        // get all
        $allProducts = Product::where('status', 1)->get();
        $productArr = [];
        $x = 0;
        $highest = 0;
        foreach ($allProducts as $row) {
            $productImages = ProductImage::where('product_id', $row->id)->get();
            foreach ($productImages as $productImage) {
                if ($highest < $productImage->id) {
                    $highest = $productImage->id;
                }
            }
            $thumbnail = ProductImage::find($highest);

            /*$productArr[$x++] = [
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
                'duration2' => $row->duration,
                'duration' => date('M d, Y', strtotime($row->duration)),
                'status' => $row->status,
                'thumbnail' => $thumbnail->image,
                'created_at' => date('M d, Y', strtotime($row->created_at))
            ];*/

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
                        'thumbnail' => empty($thumbnail) == true ? '':$thumbnail->image,
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
                    'thumbnail' => empty($thumbnail) == true ? '':$thumbnail->image,
                    'created_at' => date('M d, Y', strtotime($row->created_at)),
                    'h_bidder_id' => 'none',
                    'h_bidder' => 'none',
                    'h_bid' => 'none'
                ];
            }
            // -------------------------

            // reset highest
            $highest = 0;
        }

        $allProducts = json_decode(json_encode($productArr));
        // endddd

        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        $today = date("Y-m-d");

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        // get reported
        $reports = Report::all();
        $reportArr = [];
        foreach ($reports as $row) {
            if (!in_array($row->reported, $reportArr)) {
                array_push($reportArr, $row->reported);
            }
        }

        return view('home')
            ->with('pageTitle', 'Home')
            ->with('inboxNotif', $inboxNotif)
            ->with('reportArr', $reportArr)
            ->with('today', $today)
            ->with('newlyAddedProducts', $products)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('allProducts', $allProducts);
    }

}
