@extends('layouts.css')
@section('content')

<div class="row">

<div class="col-lg-12 ">

<br/>
<h3>update product</h3>
<hr>

</div>
</div>

<div class="row">

<div class="col-md-6">



		<br/>

	<form method="POST" action="{{{ URL::to('products/update/'.$product->id) }}}" accept-charset="UTF-8" enctype="multipart/form-data">
		
   
    <fieldset>

    <div class="form-group">
            <label for="username">Vendor </label>
            <select class="form-control" name="vendor_id">

			<option value="{{ $product->vendor->id }}"> {{$product->vendor->name}}</option>
			<option value=""> ------------------ </option>
            @foreach($vendors as $vendor)
             
              <option value="{{ $vendor->id }}"> {{ $vendor->name }} </option>
              
            </select>

            @endforeach
        </div>


        <div class="form-group">
            <label for="username">Product Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}">
        </div>

         <div class="form-group">
            <label for="username">Description</label>
            <textarea class="form-control" name="description">{{ $product->description }}</textarea>
        </div>


        <div class="form-group">
            <label for="username">Price</label>
            <input class="form-control" type="text" name="price" id="price" value="{{ $product->price }}">
        </div>


      <img src=" {{ asset('public/uploads/images/'.$product->image)}}" width="50%"/>
        

        <div class="form-group">
            <label for="username">Update Image</label>
            <input type="file" name="image" id="image"/>
        </div>

       

        
      
        
        <div class="form-actions form-group">
        	          <button type="submit" class="btn btn-primary btn-sm">update product</button>
        </div>

    </fieldset>
</form>




</div>
</div>









      	
      	
     


@stop