@extends('layouts.app')
@section('content')

<div class="container">
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
				@foreach($orders as $order)
				<tr>
					<th>{{ucfirst($order->name)}}</th>
					<td>{{$order->quantity}}</td>
					<td>{{$order->created_at}}</td>
					<td>{{$order->user->name}}</td>
					<td>{{$order->status->name}}</td>
					@if($order->status_id !== 1)
					<td>{{$order->updated_at}}</td>
					@else
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@endif
					<td class="d-flex ml-0">
						{{-- ADMIND UI --}}
					@if(auth()->user()->role_id === 1)
					@if($order->status_id === 1)
						<form action="request/approved/{{$order->id}}">
							<button class="btn btn-primary">Approved</button>
						</form>
						<form action="request/declined/{{$order->id}}">
							<button class="btn btn-danger">Declined</button>
						</form>
					@elseif($order->status_id === 3)
					<label>No Action</label>
					@elseif($order->status_id === 4)
					<form action="request/return/{{$order->id}}" method="POST">
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
							<form action="request/update/{{$order->id}}">
								<button class="btn btn-primary">Update</button>
							</form>
							<form action="request/delete/{{$order->id}}">
									<button class="btn btn-danger">Delete</button>
							</form>
						@elseif($order->status_id === 2)
							<form action="request/return/{{$order->id}}">
								<button class="btn btn-primary">Return</button>
							</form>
						@else
						<label>No Action</label>
					@endif
					@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection