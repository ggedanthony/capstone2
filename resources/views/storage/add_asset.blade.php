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
	<h1 class="text-center">Add New Asset</h1>
	<div class="row" id="main">
		<div class="col-md-8 offset-md-2">
			<form action="/storage" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="name">Name: </label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="quantity">Quantity: </label>
					<input type="number" name="quantity" class="form-control" id="quantity">
				</div>
				<div class="form-group">
					<label for="category">Category: </label>
					<select name="category" id="category" class="form-control">
						@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="image">Upload Image: </label>
					<input type="file" name="image" id="image" class="form-control">
				</div>
				<button class="btn btn-success">Add Item</button>

			</form>
		</div>		
	</div>
</div>


@endsection