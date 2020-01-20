@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row" id="main">
	<div class="d-flex col-md-10" id="menu">
		<div class="col-md-4 p-0 align-center justify-content-center align-items-center d-flex">
		<a href="/storage">
		{{count($storages)}} Total Asset
		</a>
		</div>
		
		<div id="top_option" class="col-md-3 p-0 align-center justify-content-center align-items-center d-flex">
			<a href="/request/pending">
				@if(Auth::user()->id == 1)
				{{ count($orders->where('status_id', 1)) }}
				@else
				{{ count($orders->where('status_id', 1)->whereIn('user_id', Auth::user()->id) )}}
				@endif
				Total Request
			</a>
		</div>
		<div class="col-md-3 p-0 align-center justify-content-center align-items-center d-flex">
			<a href="/request/approved">
				@if(Auth::user()->role_id == 1)
				{{ count($orders->where('status_id', 2)) }}
				@else
				{{ count($orders->where('status_id', 2)->whereIn('user_id', Auth::user()->id))}}
				@endif
			Total on Used
			</a>
			</div>
		<div class="col-md-4 p-0 align-center justify-content-center align-items-center d-flex">
		<a href="/request/hold">
				@if(Auth::user()->role_id == 1)
				{{ count($orders->where('status_id', 4)) }}
				@else
				{{ count($orders->where('status_id', 4)->whereIn('user_id', Auth::user()->id) )}}
				@endif
			Total on Hold
		</a>
		</div>
	</div>
	<br><br><br><br>
	</div>

	<div class="row d-flex" id="main">
		{{-- <h3>Dashboard</h3> --}}
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Availability</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
					
				@foreach($storages as $storage)
				<tr>
					<th>{{ucfirst($storage->name)}}</th>
					<td>{{$storage->quantity}}</td>
					<td><img src="{{$storage->image_url}}" height="50" width="50"></td>
					@if($storage->quantity > 0)
					<td class="d-flex ml-0">
						@if(auth()->user()->role_id !== 1)
						<a href="/storage/request/{{$storage->id}}" class="btn"><img src="../image/Request.png" height="20px" width="20px">Request</a>
						@endif
						@if(auth()->user()->role_id === 1)
						<a href="/storage/update/{{$storage->id}}" class="btn mr-2 ml-2"><img src="../image/update4.png" height="20px" width="20px">Update</a>
						<form action="/storage/delete/{{$storage->id}}" method="POST">
						@csrf
						@method('DELETE')
						<button class="btn"><img src="../image/Delete.png" height="20px" width="20px">Delete</button>
						</form>
						@endif
					</td>
					@else
					<td class="d-flex ml-0">
						<button class="btn" disabled=""><img src="../image/Request.png" height="20px" width="20px">Request</button>
						@if(auth()->user()->role_id === 1)
						<a href="/storage/update/{{$storage->id}}" class="btn mr-2 ml-2"><img src="../image/update4.png" height="20px" width="20px">Update</a>
						<form action="/storage/delete/{{$storage->id}}" method="POST">
						@csrf
						@method('DELETE')
						<button class="btn"><img src="../image/Delete.png" height="20px" width="20px">Delete</button>
						</form>
						@endif				
					</td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection