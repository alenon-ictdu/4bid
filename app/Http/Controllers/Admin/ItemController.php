<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductDOD;
use App\ProductImage;
use Auth;
use Image;
use File;
use App\User;
use App\Bid;
use App\AdminUserChat;
use Session;

class ItemController extends Controller
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

    	$products = Product::all();
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
            $user = User::find($row->user_id);

            /*$productArr[$x++] = [
                'id' => $row->id,
                'product_id' => $row->product_id,
                'user_id' => $row->user_id,
                'user' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
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
                        'user' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
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
                    'user' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
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

        $today = date("Y-m-d");

        return view('admin.item.index')
        	->with('products', $products)
            ->with('today', $today)
            ->with('unseenUserArr', $unseenUserArr)
            ->with('onlineUsers', $onlineUsers)
        	->with('pendingProducts', $pendingProducts)
        	->with('pageTitle', 'Admin :: Items');

    }

	public function pendingIndex() {
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

    	$products = Product::all();
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
            $user = User::find($row->user_id);

            $productArr[$x++] = [
                'id' => $row->id,
                'product_id' => $row->product_id,
                'user_id' => $row->user_id,
                'user' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
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
                'status' => $row->status,
                'thumbnail' => $thumbnail->image,
                'created_at' => date('M d, Y', strtotime($row->created_at))
            ];

            // reset highest
            $highest = 0;
        }

        $products = json_decode(json_encode($productArr));

        return view('admin.item.pdindex')
            ->with('onlineUsers', $onlineUsers)
            ->with('unseenUserArr', $unseenUserArr)
        	->with('pendingProducts', $pendingProducts)
        	->with('products', $products)
        	->with('pageTitle', 'Admin :: Pending Items');

    }

    public function declinedIndex() {
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

    	$products = Product::all();
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
            $user = User::find($row->user_id);

            $productArr[$x++] = [
                'id' => $row->id,
                'product_id' => $row->product_id,
                'user_id' => $row->user_id,
                'user' => $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname,
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
                'status' => $row->status,
                'thumbnail' => $thumbnail->image,
                'created_at' => date('M d, Y', strtotime($row->created_at))
            ];

            // reset highest
            $highest = 0;
        }

        $products = json_decode(json_encode($productArr));

        return view('admin.item.dindex')
            ->with('onlineUsers', $onlineUsers)
            ->with('unseenUserArr', $unseenUserArr)
        	->with('pendingProducts', $pendingProducts)
        	->with('products', $products)
        	->with('pageTitle', 'Admin :: Declined Items');

    }

    public function show($product_id) {
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

    	$product = Product::where('product_id', $product_id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productDOD = ProductDOD::where('product_id', $product->id)->get();

        $today = date("Y-m-d");

        // get item bidders list
        $itemBidders = Bid::where('product_id', $product->id)->get();

        // print_r($productImages);
        return view('admin.item.show')
        	->with('pendingProducts', $pendingProducts)
            ->with('itemBidders', $itemBidders)
            ->with('onlineUsers', $onlineUsers)
            ->with('today', $today)
            ->with('product', $product)
            ->with('productDOD', $productDOD)
            ->with('productImages', $productImages)
            ->with('unseenUserArr', $unseenUserArr)
            ->with('pageTitle', 'Admin :: Item '.$product_id);
    }

    public function edit($product_id) {
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

        $product = Product::where('product_id', $product_id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productDOD = ProductDOD::where('product_id', $product->id)->get();

        $today = date('m/d/Y',strtotime(date("Y/m/d")));
        $maxdate = date('m/d/Y',strtotime('+30 days',strtotime($today))) . PHP_EOL;
        $maxdate = date('Y-m-d',strtotime($maxdate));
        
        $yearsArr = [];
        for ($year=date("Y"); $year >= 1900 ; $year--) { 
            $year - 1;
            $yearsArr[$year] = $year;
        }

        return view('admin.item.edit')
        	->with('pendingProducts', $pendingProducts)
            ->with('product', $product)
            ->with('yearsArr', $yearsArr)
            ->with('unseenUserArr', $unseenUserArr)
            ->with('productImages', $productImages)
            ->with('productDOD', $productDOD)
            ->with('onlineUsers', $onlineUsers)
            ->with('maxdate', $maxdate)
            ->with('pageTitle', '')
            ->with('pageTitle', 'Admin :: Edit Item '.$product_id);
    }

    public function update(Request $request, $product_id, $id) {
        abort_if(Auth::user()->user_type == 2, 404);
        
        $product = Product::where('product_id', $product_id)->first();

        $this->validate($request, [
            'name' => 'required',
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
        ]);

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
        $product->color = $request->color;
        $product->style = $request->style;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->price = $request->price;
        $product->duration = $request->duration;
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

        return redirect()->route('product.show', $product_id);
    }

    public function approveProduct($product_id) {
    	abort_if(Auth::user()->user_type == 2, 404);
        
        $product = Product::where('product_id', $product_id)->first();
        if ($product->status == 2) {
        	return redirect()->back();
        }
        $product->status = 1;
        $product->save();

        $chat = New AdminUserChat;
        $chat->from = Auth::user()->id;
        $chat->to = $product->user->id;
        $chat->message = 'Your '.$product->brand. ' ' .$product->name. ' ' .$product->color. ' has been approved!';
        $chat->status = 0;
        $chat->save();

        Session::flash('success', 'Item has been approved');

        return redirect()->route('product.show', $product_id);
    }

    public function declineProduct($product_id) {
    	abort_if(Auth::user()->user_type == 2, 404);
        
        $product = Product::where('product_id', $product_id)->first();
        if ($product->status == 1) {
        	return redirect()->back();
        }
        $product->status = 2;
        $product->save();

        $chat = New AdminUserChat;
        $chat->from = Auth::user()->id;
        $chat->to = $product->user->id;
        $chat->message = 'Your '.$product->brand. ' ' .$product->name. ' ' .$product->color. ' has been declined!';
        $chat->status = 0;
        $chat->save();

        Session::flash('success', 'Item has been declined!');

        return redirect()->route('product.show', $product_id);
    }
}
