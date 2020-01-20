@extends('layouts.app')
@section('content')


@if(session('success_message'))
				<div class="container">
					<div class="alert alert-success">
						{{session('success_message')}}
					</div>
				</div>
			@endif
<div class="container">
	<h1 class="text-center">Update Request Asset</h1>
	<div class="row" id="main">
		<div class="col-md-8 offset-md-2">
			<form action="" method="POST">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label for="name">Name: </label>
					<input type="text" name="name" class="form-control" value="{{$order->name}}" readonly="">
				</div>
				<div class="form-group">
					<label for="avalability">Avalability: </label>
					<input type="number" name="avalability" class="form-control" value="{{$item->quantity}}" readonly="">
				</div>
				<div class="form-group">
					<label for="quantity">Quantity: </label>
					<input type="number" name="quantity" class="form-control" id="quantity" value="{{$order->quantity}}" max="{{$item->quantity}}" min="1">
				</div>
				
				<button class="btn btn-success">Update Request Asset</button>

			</form>
		</div>		
	</div>
</div>


@endsection