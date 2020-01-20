@extends('layouts.app')
@section('content')


<div class="container">
<div class="row" id="main">
	<div class="d-flex col-md-10" id="menu">
		<div class="col-md-4 p-0 align-center justify-content-center align-items-center d-flex"><a href="/storage">{{count($storages)}} Total Asset</a>
		</div>
		<div class="col-md-3 p-0 align-center justify-content-center align-items-center d-flex" id="total_request">
			<a href="/request/pending">
				@if(Auth::user()->role_id == 1)
				{{ count($orders->where('status_id', 1)) }}
				@else
				{{ count($orders->where('status_id', 1)->whereIn('user_id', Auth::user()->id) )}}
				@endif
				Total Request
			</a>
		</div>
		<div class="col-md-3 p-0 align-center justify-content-center align-items-center d-flex" id="total_used">
			<a href="/request/approved">
				@if(Auth::user()->role_id == 1)
				{{ count($orders->where('status_id', 2)) }}
				@else
				{{ count($orders->where('status_id', 2)->whereIn('user_id', Auth::user()->id) )}}
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

	<div class="row" id="main">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Date of Order</th>
					<th>Requestor</th>
					<th>Status</th>
					<th>Updated On</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
				@if(Auth::user()->role_id == 1)
				@foreach($orders->where('status_id', 2) as $order)
				<tr>
					<th>{{ucfirst($order->name)}}</th>
					<td>{{$order->quantity}}</td>
					<td>{{$order->created_at->diffForHumans()}}</td>
					<td>{{$order->user->name}}</td>
					<td>{{$order->status->name}}</td>
					@if($order->status_id !== 1)
					<td>{{$order->updated_at->diffForHumans()}}</td>
					@else
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@endif
					<td class="d-flex ml-0">
						{{-- ADMIND UI --}}
					@if(auth()->user()->role_id === 1)
					@if($order->status_id === 1)
						<form action="/request/approved/{{$order->id}}">
							<button class="btn btn-primary">Approved</button>
						</form>
						<form action="/request/declined/{{$order->id}}">
							<button class="btn btn-danger">Declined</button>
						</form>
					@elseif($order->status_id === 3)
					<label>No Action</label>
				{{-- 	@elseif($order->status_id === 2)
					<form action="/request/return/{{$order->id}}" method="POST">
						@csrf
						@method('put')
						<button class="btn btn-primary">Return</button>
					</form> --}}
					@else
					<label>No Action</label>
					@endif
					@endif
					
					{{-- USER UI --}}

					@if(auth()->user()->role_id === 2)
						@if($order->status_id === 1)
							<form action="/request/update/{{$order->id}}">
								<button class="btn btn-primary">Update</button>
							</form>
							<form action="/request/delete/{{$order->id}}">
									<button class="btn btn-danger">Delete</button>
							</form>
						@elseif($order->status_id === 2)
							<form action="/request/return/{{$order->id}}">
								<button class="btn btn-primary">Return</button>
							</form>
						@else
						<label>No Action</label>
					@endif
					@endif
					</td>
				</tr>
			@endforeach

{{-- else for user UI --}}
			@else
			@foreach($orders->where('status_id', 2)->whereIn('user_id', Auth::user()->id) as $order)
				<tr>
					<th>{{ucfirst($order->name)}}</th>
					<td>{{$order->quantity}}</td>
					<td>{{$order->created_at->diffForHumans()}}</td>
					<td>{{$order->user->name}}</td>
					<td>{{$order->status->name}}</td>
					@if($order->status_id !== 1)
					<td>{{$order->updated_at->diffForHumans()}}</td>
					@else
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@endif
					<td class="d-flex ml-0">
						{{-- ADMIND UI --}}
					@if(auth()->user()->role_id === 1)
					@if($order->status_id === 1)
						<form action="/request/approved/{{$order->id}}">
							<button class="btn btn-primary">Approved</button>
						</form>
						<form action="/request/declined/{{$order->id}}">
							<button class="btn btn-danger">Declined</button>
						</form>
					@elseif($order->status_id === 3)
					<label>No Action</label>
					@elseif($order->status_id === 2)
					<form action="/request/return/{{$order->id}}" method="POST">
						@csrf
						@method('put')
						<button class="btn btn-primary">Return</button>
					</form>
					@else
					<label>No Action</label>
					@endif
					@endif
					
					{{-- USER UI --}}

					@if(auth()->user()->role_id === 2)
						@if($order->status_id === 1)
							<form action="/request/update/{{$order->id}}">
								<button class="btn btn-primary">Update</button>
							</form>
							<form action="/request/delete/{{$order->id}}">
									<button class="btn btn-danger">Delete</button>
							</form>
						@elseif($order->status_id === 2)
							<form action="/request/return/{{$order->id}}">
								<button class="btn btn-primary">Return</button>
							</form>
						@else
						<label>No Action</label>
					@endif
					@endif
					</td>
				</tr>
			@endforeach
			@endif
			</tbody>
		</table>
	</div>
</div>

@endsection