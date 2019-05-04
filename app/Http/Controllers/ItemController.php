<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Bid;
use App\Report;
use App\ProductImage;
use App\ProductDOD;
use Auth;
use Image;
use File;
use Session;
use App\AdminUserChat;
use App\Inbox;
use App\PaymentLog;

class ItemController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
        abort_if(Auth::user()->user_type == 1, 404);

        $products = Product::where('user_id', Auth::user()->id)->get();
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


        // get bid history
        $bidHistory = Bid::where('user_id', Auth::user()->id)->get();
        // bid history end

        $products = json_decode(json_encode($productArr));

        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        $today = date("Y-m-d");

        return view('member.item.index')
            ->with('bidHistory', $bidHistory)
            ->with('inboxNotif', $inboxNotif)
            ->with('products', $products)
            ->with('today', $today)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('pageTitle', '4Bid');
    }

    public function create() {
        abort_if(Auth::user()->user_type == 1, 404);

        $today = date('m/d/Y',strtotime(date("Y/m/d")));
        $maxdate = date('m/d/Y',strtotime('+30 days',strtotime($today))) . PHP_EOL;
        $maxdate = date('Y-m-d',strtotime($maxdate));
    	
    	$yearsArr = [];
        for ($year=date("Y"); $year >= 1900 ; $year--) { 
        	$year - 1;
            $yearsArr[$year] = $year;
        }
        
        $productID = '1500'.rand(1, 10000);
        $products = Product::all();
        while (Product::where('product_id', $productID)->count() > 0) {
        	$productID = '1500'.rand(1, 10000);
        }

        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

    	return view('member.item.create')
    		->with('pageTitle', 'Add Item')
    		->with('yearsArr', $yearsArr)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('inboxNotif', $inboxNotif)
    		->with('productID', $productID)
            ->with('maxdate', $maxdate);
    }

    public function store(Request $request) {
        abort_if(Auth::user()->user_type == 1, 404);

        $this->validate($request, [
            'product_id' => 'required|unique:product,product_id',
            'name' => 'required',
            'price' => 'required',
            'color' => 'required',
            'style' => 'required',
            'brand' => 'required',
            'series' => 'required',
            'denomination' => 'required',
            'piston' => 'required',
            'cylinder' => 'required',
            'fuel' => 'required',
            'milage' => 'required',
            'year' => 'required|not_in:none',
            'product_image' => 'required',
            'product_dod' => 'required',
            'duration' => 'required'
        ]);

        // save product
        $product = New Product;
        $product->product_id = $request->product_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->user_id = Auth::user()->id;
        $product->color = $request->color;
        $product->style = $request->style;
        $product->brand = $request->brand;
        $product->series = $request->series;
        $product->denomination = $request->denomination;
        $product->piston = $request->piston;
        $product->cylinder = $request->cylinder;
        $product->fuel = $request->fuel;
        $product->milage = $request->milage;
        $product->year = $request->year;
        $product->duration = $request->duration;
        $product->status = 0;
        $product->status2 = 0;
        $product->save();

        // save product images
        if ($request->hasFile('product_image')) {

            $allowedfileExtension = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'];
            $photos = $request->file('product_image');

            foreach ($photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $photoName = str_replace(' ', '', $photoName);
                $extension = $photo->getClientOriginalExtension();
                $photoName = str_replace('.'.$extension, '', $photoName);
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = $photoName.time() . '.' . $photo->getClientOriginalExtension();
                    $location = public_path('uploads/images/' . $filename);
                    // Image::make($photo)->resize(800, 400)->save($location);
                    Image::make($photo)->save($location);

                    

                    // save album images    
                    $image = New ProductImage;
                    $image->product_id = $product->id;
                    $image->image = $filename;
                    $image->save();
                    
                }
            }

        }

        // product dod
        if ($request->hasFile('product_dod')) {

            $allowedfileExtension = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'];
            $photos = $request->file('product_dod');

            foreach ($photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $photoName = str_replace(' ', '', $photoName);
                $extension = $photo->getClientOriginalExtension();
                $photoName = str_replace('.'.$extension, '', $photoName);
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = $photoName.time() . '.' . $photo->getClientOriginalExtension();
                    $location = public_path('uploads/dod/' . $filename);
                    // Image::make($photo)->resize(800, 400)->save($location);
                    Image::make($photo)->save($location);

                    

                    // save album images    
                    $image = New ProductDOD;
                    $image->product_id = $product->id;
                    $image->image = $filename;
                    $image->save();
                    
                }
            }

        }

        // payment log
        $paymentLog = New PaymentLog;
        $paymentLog->action = 'Posting';
        $paymentLog->description = 'Payment from '. Auth::user()->firstname. ' ' .Auth::user()->middlename. ' ' .Auth::user()->lastname;
        $paymentLog->amount = '2000';
        $paymentLog->save();

        return redirect()->route('item.show', $product->product_id);
    }

    public function show($product_id) {
        abort_if(Auth::user()->user_type == 1, 404);

        $product = Product::where('product_id', $product_id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productDOD = ProductDOD::where('product_id', $product->id)->get();

        if (Auth::user()->id != $product->user_id) {
            return redirect()->back();
        }
        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();
        // print_r($productImages);
        $today = date("Y-m-d");

        // get the highest bid
        $bid = Bid::where('product_id', $product->id)->get();
        // echo $bid->max('bid');
        $max = Bid::where([['product_id', $product->id], ['bid', $bid->max('bid')]])->orderBy('id', 'asc')->get();

        // print_r($max);
        if($max->count() > 0) {
            foreach ($max as $row) {
                $highestBidder = $row;
                break;
            }
        } else {
            $highestBidder = 'None';
        }
        // -------------------------
        // echo $highestBidder;

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        // get reported
        $reports = Report::where('reporter', Auth::user()->id)->get();
        $reportArr = [];
        foreach ($reports as $row) {
            if (!in_array($row->reported, $reportArr)) {
                array_push($reportArr, $row->reported);
            }
        }

        return view('member.item.show')
            ->with('reportArr', $reportArr)
            ->with('product', $product)
            ->with('highestBidder', $highestBidder)
            ->with('today', $today)
            ->with('productDOD', $productDOD)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('inboxNotif', $inboxNotif)
            ->with('productImages', $productImages)
            ->with('pageTitle', 'Item :: '.$product_id);
    }

    public function edit($product_id) {
        abort_if(Auth::user()->user_type == 1, 404);

        $product = Product::where('product_id', $product_id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productDOD = ProductDOD::where('product_id', $product->id)->get();

        if ($product->status == 1) {
            return redirect()->back();
        }
        if (Auth::user()->id != $product->user_id) {
            return redirect()->back();
        }

        $today = date('m/d/Y',strtotime(date("Y/m/d")));
        $maxdate = date('m/d/Y',strtotime('+30 days',strtotime($today))) . PHP_EOL;
        $maxdate = date('Y-m-d',strtotime($maxdate));
        
        $yearsArr = [];
        for ($year=date("Y"); $year >= 1900 ; $year--) { 
            $year - 1;
            $yearsArr[$year] = $year;
        }

        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        return view('member.item.edit')
            ->with('product', $product)
            ->with('yearsArr', $yearsArr)
            ->with('productImages', $productImages)
            ->with('productDOD', $productDOD)
            ->with('maxdate', $maxdate)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('inboxNotif', $inboxNotif)
            ->with('pageTitle', '')
            ->with('pageTitle', 'Edit :: '.$product_id);
    }

    public function update(Request $request, $product_id, $id) {
        abort_if(Auth::user()->user_type == 1, 404);
        
        $product = Product::where('product_id', $product_id)->first();

        if ($product->status == 1) {
            return redirect()->back();
        }
        if (Auth::user()->id != $product->user_id) {
            return redirect()->back();
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'color' => 'required',
            'style' => 'required',
            'brand' => 'required',
            'series' => 'required',
            'denomination' => 'required',
            'piston' => 'required',
            'cylinder' => 'required',
            'fuel' => 'required',
            'milage' => 'required',
            'year' => 'required|not_in:none',
            // 'product_image' => 'required'
        ]);

        // print_r($_POST);

        // remove the deleted image
        $photos = ProductImage::where('product_id', $id)->get();
        // print_r($photos);
        foreach ($photos as $photo) {
            $check = in_array($photo->id, $_POST);
            if ($check) {
                continue;
            } else {
                $singlePhoto = ProductImage::find($photo->id);
                $oldImage = $singlePhoto->image;
                File::delete(public_path('uploads/images/'. $oldImage)); // delete old image
                $singlePhoto->delete();
            }
        }

        // remove the deleted dod image
        $photos = ProductDOD::where('product_id', $id)->get();
        /*print_r($_POST);
        foreach ($photos as $p) {
            echo "$p <br>";
        }*/
        foreach ($photos as $photo) {
            $check = in_array('dod'.$photo->id, $_POST);
            if ($check) {
                continue;
            } else {
                $singlePhoto = ProductDOD::find($photo->id);
                $oldImage = $singlePhoto->image;
                File::delete(public_path('uploads/dod/'. $oldImage)); // delete old image
                $singlePhoto->delete();
            }
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->color = $request->color;
        $product->style = $request->style;
        $product->brand = $request->brand;
        $product->series = $request->series;
        $product->denomination = $request->denomination;
        $product->piston = $request->piston;
        $product->cylinder = $request->cylinder;
        $product->fuel = $request->fuel;
        $product->milage = $request->milage;
        $product->year = $request->year;
        $product->save();

        // save product images
        if ($request->hasFile('product_image')) {

            $allowedfileExtension = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'];
            $photos = $request->file('product_image');

            foreach ($photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $photoName = str_replace(' ', '', $photoName);
                $extension = $photo->getClientOriginalExtension();
                $photoName = str_replace('.'.$extension, '', $photoName);
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = $photoName.time() . '.' . $photo->getClientOriginalExtension();
                    $location = public_path('uploads/images/' . $filename);
                    // Image::make($photo)->resize(800, 400)->save($location);
                    Image::make($photo)->save($location);

                    

                    // save album images    
                    $image = New ProductImage;
                    $image->product_id = $product->id;
                    $image->image = $filename;
                    $image->save();
                    
                }
            }

        }

        // product dod
        if ($request->hasFile('product_dod')) {

            $allowedfileExtension = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'];
            $photos = $request->file('product_dod');

            foreach ($photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $photoName = str_replace(' ', '', $photoName);
                $extension = $photo->getClientOriginalExtension();
                $photoName = str_replace('.'.$extension, '', $photoName);
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = $photoName.time() . '.' . $photo->getClientOriginalExtension();
                    $location = public_path('uploads/dod/' . $filename);
                    // Image::make($photo)->resize(800, 400)->save($location);
                    Image::make($photo)->save($location);

                    

                    // save album images    
                    $image = New ProductDOD;
                    $image->product_id = $product->id;
                    $image->image = $filename;
                    $image->save();
                    
                }
            }

        }

        Session::flash('success', 'Item has been updated');

        return redirect()->route('item.show', $product_id);
    }

    public function details($product_id) {
        abort_if(Auth::user()->user_type == 1, 404);

        $product = Product::find($product_id);
        $today = date("Y-m-d");

        if ($product->status == 2 || $product->status == 0) {
            return redirect()->back();
        }/*
        if ($today > $product->duration) {
            return redirect()->back();
        }*/

        $productImages = ProductImage::where('product_id', $product_id)->get();
        $productDOD = ProductDOD::where('product_id', $product_id)->get();

        // print_r($productImages);
        $chatniAdmin = AdminUserChat::where([['to', Auth::user()->id], ['status', 0]])->orderBy('created_at', 'asc')->get();

        // get the highest bid
        $bid = Bid::where('product_id', $product_id)->get();
        // echo $bid->max('bid');
        $max = Bid::where([['product_id', $product_id], ['bid', $bid->max('bid')]])->orderBy('id', 'asc')->get();

        // print_r($max);
        if($max->count() > 0) {
            foreach ($max as $row) {
                $highestBidder = $row;
                break;
            }
        } else {
            $highestBidder = 'None';
        }
        // -------------------------

        // get inbox notif
        $inboxNotif = Inbox::where([['status', 0], ['user_id', Auth::user()->id]])->get();

        // get reported
        $reports = Report::where('reporter', Auth::user()->id)->get();
        $reportArr = [];
        foreach ($reports as $row) {
            if (!in_array($row->reported, $reportArr)) {
                array_push($reportArr, $row->reported);
            }
        }

        return view('member.item.details')
            ->with('pageTitle', '4Bid')
            ->with('highestBidder', $highestBidder)
            ->with('inboxNotif', $inboxNotif)
            ->with('reportArr', $reportArr)
            ->with('product', $product)
            ->with('productDOD', $productDOD)
            ->with('chatniAdmin', $chatniAdmin)
            ->with('productImages', $productImages);
    }

    public function destroy($id) {
        $item = Product::find($id);
        // $oldImage = $logo->image;

        $item->delete();
        // File::delete(public_path('img/logo/'. $oldImage)); // delete old image

        // show a success message
        Session::flash('success','Item has been deleted.');

        return redirect()->route('item.index');
    }

}
