<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;
use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;


class LandingController extends Controller
{
    public function landingPage(Request $request) {
        $products = Product::orderBy('updated_at', 'desc')->get();
        $productArr = [];
        $highest = 0;
        $x = 0;
        foreach ($products as $row) {
            if($row->status != 1) {
                continue;
            }
            $productImages = ProductImage::where('product_id', $row->id)->get();
            foreach ($productImages as $productImage) {
                if ($highest < $productImage->id) {
                    $highest = $productImage->id;
                }
            }
            $thumbnail = ProductImage::find($highest);

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
                'thumbnail' => $thumbnail->image,
                'created_at' => date('M d, Y', strtotime($row->created_at))
            ];
        }

        $productArr = json_decode(json_encode($productArr));

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($productArr);
 
        // Define how many items we want to be visible in each page
        $perPage = 8;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $lToday = date("Y-m-d");

        return view('welcome')
            ->with('lToday', $lToday)
            ->with('products', $paginatedItems);
    }
    public function oldlandingPage() {
    	// get highest 
    	$highestBid = Bid::max('bid');
    	// get second highest
    	$bids = Bid::where('bid', '!=', $highestBid)->get();
    	$secondHighestBid = 0;
    	foreach ($bids as $row) {
    		if ($secondHighestBid < $row->bid) {
    			$secondHighestBid = $row->bid;
    		}
    	}

    	$high = Bid::where('bid', $highestBid)->first();
    	$second = Bid::where('bid', $secondHighestBid)->first();
    	$cars = Product::all();
    	$highThumb = 'default';
    	$secondThumb = 'default';
    	if ($high != '') {
    		$highThumb = ProductImage::where('product_id', $high->product->id)->first();
    	}
    	if ($second != '') {
    		$secondThumb = ProductImage::where('product_id', $second->product->id)->first();
    	}
    	
    	$today = date('Y-m-d');
    	// echo $secondThumb. "<br>" .$second->product;


    	// get 7 days old
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
                        'thumbnail' => $thumbnail->image,
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
                    'thumbnail' => $thumbnail->image,
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

        // get hottest car
        $t = date('Y-m-d');
        $currentHot = Product::where([['duration', '>=', date('Y-m-d h:i:s', strtotime($t)) ], ['status', 1]])->first();
        $ps = Product::where([['duration', '>=', date('Y-m-d h:i:s', strtotime($t)) ], ['status', 1]])->get();
        // print_r($currentHot);
        foreach ($ps as $row) {
        	if ($row->created_at > $currentHot->created_at) {
        		$currentHot = $row;
        	}
        }

        if ($currentHot === null) {
            $currentHotThumbnail = 'None';
            $days = 0;
        } else {
            $currentHotThumbnail = ProductImage::where('product_id', $currentHot->id)->first();
            $date1 = new DateTime(date('Y-m-d'));  //current date or any date
            $date2 = new DateTime(date('Y-m-d',strtotime($currentHot->duration)));   //Future date
            $diff = $date2->diff($date1)->format("%a");  //find difference
            $days = intval($diff);   //rounding days
        }
        // $currentHotThumbnail = ProductImage::where('product_id', $currentHot->id)->first();

        // $f = date('d F Y', strtotime($currentHot->duration));
        /*$date1 = new DateTime(date('Y-m-d'));  //current date or any date
	    $date2 = new DateTime(date('Y-m-d',strtotime($currentHot->duration)));   //Future date
	    $diff = $date2->diff($date1)->format("%a");  //find difference
	    $days = intval($diff);   //rounding days*/
	    // echo $days;

        // endddddddd

        // get cheapest first
	    $cheapestFirst = Product::where('status', 1)->orderBy('price', 'asc')->paginate(8);
		$cheapProductArr = [];
        $c = 0;
        $cHighest = 0;
        foreach ($cheapestFirst as $row) {
            $productImages = ProductImage::where('product_id', $row->id)->get();
            foreach ($productImages as $productImage) {
                if ($cHighest < $productImage->id) {
                    $cHighest = $productImage->id;
                }
            }
            $thumbnail = ProductImage::find($cHighest);

            // get the highest bid
            $bid = Bid::where('product_id', $row->id)->get();
            // echo $bid->max('bid');
            $max = Bid::where([['product_id', $row->id], ['bid', $bid->max('bid')]])->orderBy('id', 'asc')->get();

            // print_r($max);
            if($max->count() > 0) {
                foreach ($max as $d) {
                    $cheapProductArr[$c++] = [
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
                        'created_at' => date('M d, Y', strtotime($row->created_at)),
                        'h_bidder_id' => $d->user_id,
                        'h_bidder' => $d->user->firstname. ' ' .$d->user->middlename. ' ' .$d->user->lastname,
                        'h_bid' => $d->bid
                    ];
                    break;
                }
            } else {
                $cheapProductArr[$c++] = [
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
                    'created_at' => date('M d, Y', strtotime($row->created_at)),
                    'h_bidder_id' => 'none',
                    'h_bidder' => 'none',
                    'h_bid' => 'none'
                ];
            }
            // -------------------------

            // reset highest
            $cHighest = 0;
        }

        $cheapestFirst = json_decode(json_encode($cheapProductArr));
        // endddddd

        // get see also
        $seeAlso = Product::where('status', 1)->paginate(12);
        $seeAlsoArr = [];
        $sa = 0;
        $saHighest = 0;
        foreach ($seeAlso as $row) {
            $productImages = ProductImage::where('product_id', $row->id)->get();
            foreach ($productImages as $productImage) {
                if ($saHighest < $productImage->id) {
                    $saHighest = $productImage->id;
                }
            }
            $thumbnail = ProductImage::find($saHighest);

            // get the highest bid
            $bid = Bid::where('product_id', $row->id)->get();
            // echo $bid->max('bid');
            $max = Bid::where([['product_id', $row->id], ['bid', $bid->max('bid')]])->orderBy('id', 'asc')->get();

            // print_r($max);
            if($max->count() > 0) {
                foreach ($max as $d) {
                    $seeAlsoArr[$sa++] = [
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
                        'created_at' => date('M d, Y', strtotime($row->created_at)),
                        'h_bidder_id' => $d->user_id,
                        'h_bidder' => $d->user->firstname. ' ' .$d->user->middlename. ' ' .$d->user->lastname,
                        'h_bid' => $d->bid
                    ];
                    break;
                }
            } else {
                $seeAlsoArr[$sa++] = [
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
                    'created_at' => date('M d, Y', strtotime($row->created_at)),
                    'h_bidder_id' => 'none',
                    'h_bidder' => 'none',
                    'h_bid' => 'none'
                ];
            }
            // -------------------------

            // reset highest
            $saHighest = 0;
        }

        $seeAlso = json_decode(json_encode($seeAlsoArr));
        // end


    	return view('welcome')
    		->with('high', $high)
    		->with('cheapestFirst', $cheapestFirst)
    		->with('products', $products)
    		->with('seeAlso', $seeAlso)
    		->with('today', $today)
    		->with('days', $days)
    		->with('highThumb', $highThumb)
    		->with('second', $second)
    		->with('currentHot', $currentHot)
    		->with('currentHotThumbnail', $currentHotThumbnail)
    		->with('secondThumb', $secondThumb);
    }

    public function searchCars(Request $request) {
        $quary = $request->quary;
        $products = Product::where('name', 'LIKE', '%' . $quary . '%')
                    ->orWhere('price', 'LIKE', '%' . $quary . '%')
                    ->orWhere('color', 'LIKE', '%' . $quary . '%')
                    ->orWhere('style', 'LIKE', '%' . $quary . '%')
                    ->orWhere('brand', 'LIKE', '%' . $quary . '%')
                    ->orWhere('year', 'LIKE', '%' . $quary . '%')
                    ->get();

        $productArr = [];
        $highest = 0;
        $x = 0;
        foreach ($products as $row) {
            if($row->status != 1) {
                continue;
            }
            $productImages = ProductImage::where('product_id', $row->id)->get();
            foreach ($productImages as $productImage) {
                if ($highest < $productImage->id) {
                    $highest = $productImage->id;
                }
            }
            $thumbnail = ProductImage::find($highest);

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
                'thumbnail' => $thumbnail->image,
                'created_at' => date('M d, Y', strtotime($row->created_at))
            ];
        }

        $productArr = json_decode(json_encode($productArr));


        return view('welcome-search')
            ->with('products', $productArr)
            ->with('quary', $quary);
        
    }
}
