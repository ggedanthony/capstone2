<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Storage;
use App\Order;
use App\Repair;
use App\User;


class StorageController extends Controller
{
 	//show all assets
 	public function index(){
 		$storages = Storage::all();
 		$categories = Category::all();
 		$orders = Order::all();
 		if(!Auth::user()){
			return redirect('/');
		}
 		return view('storage.assets', compact('storages', 'categories', 'orders'));
 		
 	}

 	//go to add asset form
 	public function add_asset_form(){
 		if(!Auth::user()){
			return redirect('/');
		}
 		$categories = Category::all();
 		return view('storage.add_asset', compact('categories'));
 	}

 	//logic to add a asset
 	public function add_asset(Request $request){
 		if(!Auth::user()){
			return redirect('/');
		}
 		$storage = new Storage;
 		$storage->name = $request->name;
 		$storage->quantity = $request->quantity;
 		$storage->category_id = $request->category;
 		$image = $request->file('image');
		$image_name = time() . "." . $image->getClientOriginalExtension();
		$destination = "images/";
		$storage->image_url = $image->move($destination, $image_name);
		$storage->save();
		session()->flash('success_message', 'Item Added successfully');
		return redirect('/storage');
 	}

 	//go to update asset form
 	public function update_asset_form($id){
 		if(!Auth::user()){
			return redirect('/');
		}
 		$asset=Storage::find($id);
		$categories=Category::all();
		return view('storage.update', compact('asset','categories'));
 	}

 	//logic to update a asset
 	public function update_asset($id, Request $request){
 		if(!Auth::user()){
			return redirect('/');
		}
 		$asset = Storage::find($id);
 		$asset->name = $request->name;
 		$asset->quantity = $request->quantity;
 		$asset->category_id = $request->category;
 		if($request->file('image') != null){
			$image = $request->file('image');
			$image_name = time(). "." . $image->getClientOriginalExtension();
			$destination = "images/";
			$image->move($destination, $image_name);
			$asset->image_url = $destination.$image_name;
		}  
		$asset->save();
		session()->flash('success_message', 'Item Updated successfully');
		return redirect("/storage");
 	}
 	public function delete_asset($id){
		$asset = Storage::find($id);
		$asset->delete();
		return redirect('/storage');
	}

	
	
}
