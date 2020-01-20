<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Storage;
use App\Category;
use App\User;



class OrderController extends Controller
{
     public function request_asset_form($id){
     	if(!Auth::user()){
			return redirect('/');
		}
		$asset = Storage::find($id);
		$categories = Category::all();		
		return view('request.request', compact('asset', 'categories'));
	}

	public function request_asset($id, Request $request){
		if(!Auth::user()){
			return redirect('/');
		}
		$asset = Storage::find($id);
		$order = new Order;
		$order->name = $asset->name;
		$order->quantity = $request->quantity;
		$order->storage_id = $asset->id;
		$order->user_id = Auth::user()->id;
		$order->status_id = 1;
		$order->category_id = $asset->category_id;
		$order->save();
		return redirect('/storage');
	}

	public function view_request(){
		if(!Auth::user()){
			return redirect('/');
		}
		if(Auth::user()->id === 1){
		$orders = Order::all();
		}else{
		$orders = Order::get()->where('user_id', Auth::user()->id);
		}	

		return view('request.view_request', compact('orders'));
	}

	public function approve($id){
		$order = Order::find($id);
		$item = Storage::find($order->storage_id);
		$order->status_id = 2;
		$new_quantity = $item->quantity - $order->quantity;
		$item->quantity = $new_quantity;
		$order->save();
		$item->save();
		return redirect('/request/pending');
	}

	public function decline($id){
		$order = Order::find($id);
		$order->status_id = 3;
		$order->save();
		return redirect('/request/pending');	
	}

	public function delete($id){
		$order = Order::find($id);
		$order->delete();
		return redirect('/request/pending');
	}

	public function update_request($id){
		if(!Auth::user()){
			return redirect('/');
		}
		$order = Order::find($id);
		$item = Storage::find($order->storage_id);
		return view('request.update_request', compact('order', 'item'));
	}

	public function updating_request($id, Request $request){
		if(!Auth::user()){
			return redirect('/');
		}
		$order = Order::find($id);
		$order->quantity = $request->quantity;
		$order->save();
		return redirect('/request/pending');
	}

	public function return_request($id){
		$order = Order::find($id);
		$order->status_id = 4;
		$order->save();
		return redirect('/request/approved');
	}

	public function return_asset($id){
		$order = Order::find($id);
		$asset = Storage::find($order->storage_id);
		$order->status_id = 5;
		$asset->quantity = $asset->quantity + $order->quantity;
		$order->save();
		$asset->save();
		return redirect('/request/hold');
	}

	public function view_pending(){
		if(!Auth::user()){
			return redirect('/');
		}
		$storages = Storage::all();
		$orders = Order::all();	
		return view('request.view_pending', compact('orders', 'storages'));
	}

	public function view_approved(){
		if(!Auth::user()){
			return redirect('/');
		}
		$orders = Order::all();
		$storages = Storage::all();
		return view('request.view_approved', compact('orders', 'storages'));	
	}

	public function view_hold(){
		if(!Auth::user()){
			return redirect('/');
		}
		$storages = Storage::all();
		$orders = Order::all();
		return view('request.view_hold', compact('orders', 'storages'));	
	}

	public function history(){
		if(!Auth::user()){
			return redirect('/');
		}
		$orders = Order::orderBy('updated_at', 'desc')->get();
		return view('request.history', compact('orders'));
	}

}
