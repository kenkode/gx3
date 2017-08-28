@extends('layouts.css')
@section('content')

<div class="row">

<div class="col-lg-12 ">

<br/>
<h3>new vendor</h3>
<hr>

</div>
</div>

<div class="row">

<div class="col-md-6">



		<br/>

		
		<form method="POST" action="{{{ URL::to('vendors/update/'.$vendor->id) }}}" accept-charset="UTF-8" >
	
   
    <fieldset>

    


        <div class="form-group">
            <label for="username">Vendor Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ $vendor->name}}">
        </div>

        <div class="form-group">
            <label for="username">Phone Number</label>
            <input class="form-control" type="text" name="phone" id="phone" value="{{ $vendor->phone}}">
        </div>

        <div class="form-group">
            <label for="username">Phone Email</label>
            <input class="form-control" type="text" name="email" id="email" value="{{ $vendor->email }}">
        </div>

         <div class="form-group">
            <label for="username">Description</label>
            <textarea class="form-control" name="description">{{ $vendor->description}}</textarea>
        </div>


        
        <div class="form-actions form-group">
        	          <button type="submit" class="btn btn-primary btn-sm">update vendor</button>
        </div>

    </fieldset>
</form>




</div>
</div>









      	
      	
     


@stop