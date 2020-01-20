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
	<h1 class="text-center">Update Asset</h1>
	<div class="row" id="main">
		<div class="col-md-8 offset-md-2">
			<form action="/storage/update/{{$asset->id}}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PATCH')
				<div class="form-group">
					<label for="name">Name: </label>
					<input type="text" name="name" class="form-control" value="{{$asset->name}}">
				</div>
				<div class="form-group">
					<label for="quantity">Quantity: </label>
					<input type="number" name="quantity" class="form-control" id="quantity" value="{{$asset->quantity}}">
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
					<img src="/{{$asset->image_url}}" height="150" width="150"><br>
					<label for="image">Upload Image: </label>
					<input type="file" name="image" id="image" class="form-control">
				</div>
				<button class="btn btn-success">Update Asset</button>

			</form>
		</div>		
	</div>
</div>


@endsection