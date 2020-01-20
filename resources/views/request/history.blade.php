@extends('layouts.app')
@section('content')


<div class="container">
	<div class="row" id="main">
		<table class="table">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>User</th>
					<th>Name of Asset</th>
					<th>Quantity</th>
					<th>Status</th>
					<th>Updated On</th>
					
				</tr>
			</thead>
			<tbody>
				@if(Auth::user()->role_id == 1)

				@foreach($orders as $order)
				<tr>
					<th>{{ucfirst($order->id)}}</th>
					<td>{{$order->user->name}}</td>
					<td>{{$order->name}}</td>
					<td>{{$order->quantity}}</td>
					<td>{{$order->status->name}}</td>
					@if($order->status_id !== 1)
					<td>{{$order->updated_at->diffForHumans()}}</td>
					{{-- <td>{{ date('d-m-Y', strtotime($order->updated_at)) }}</td> --}}
					@else
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@endif
				</tr>
			@endforeach

{{-- else for user UI --}}
			@else
			@foreach($orders -> whereIn('user_id', Auth::user()->id) as $order)
				<tr>
					<th>{{ucfirst($order->id)}}</th>
					<td>{{$order->user->name}}</td>
					<td>{{$order->name}}</td>
					<td>{{$order->quantity}}</td>
					<td>{{$order->status->name}}</td>
					@if($order->status_id !== 1)
					<td>{{$order->updated_at->diffForHumans()}}</td>
					@else
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@endif
					
				</tr>
			@endforeach
			@endif
			</tbody>
		</table>
	</div>
</div>

@endsection