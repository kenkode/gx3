@extends('layouts.css')
@section('content')

<div class="row">

<div class="col-lg-12 ">

<br/>
<h3>new product</h3>
<hr>

</div>
</div>

<div class="row">

<div class="col-md-6">



		<br/>

		
		{{ Form::open(array('action' => 'ProductsController@store', 'files'=>true)) }}
   
    <fieldset>

    <div class="form-group">
            <label for="username">Vendor </label>
            <select class="form-control" name="vendor_id">

			<option value=""> select vendor </option>
			<option value=""> ------------------ </option>
            @foreach($vendors as $vendor)
             
              <option value="{{ $vendor->id }}"> {{ $vendor->name }} </option>
              @endforeach
              
            </select>

            
        </div>


        <div class="form-group">
            <label for="username">Product Name</label>
            <input class="form-control" type="text" name="name" id="name" value="">
        </div>

         <div class="form-group">
            <label for="username">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>


        <div class="form-group">
            <label for="username">Price</label>
            <input class="form-control" type="text" name="price" id="price" value="">
        </div>


      
        

        <div class="form-group">
            <label for="username">Image</label>
            <input type="file" name="image" id="image"/>
        </div>

       

        
      
        
        <div class="form-actions form-group">
        	          <button type="submit" class="btn btn-primary btn-sm">Create product</button>
        </div>

    </fieldset>
</form>




</div>
</div>









      	
      	
     


@stop