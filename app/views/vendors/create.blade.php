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

		
		{{ Form::open(array('action' => 'VendorsController@store')) }}
   
    <fieldset>

    


        <div class="form-group">
            <label for="username">Vendor Name</label>
            <input class="form-control" type="text" name="name" id="name" value="">
        </div>

        <div class="form-group">
            <label for="username">Phone Number</label>
            <input class="form-control" type="text" name="phone" id="phone" value="">
        </div>

        <div class="form-group">
            <label for="username">Vendor Email</label>
            <input class="form-control" type="text" name="email" id="email" value="">
        </div>

         <div class="form-group">
            <label for="username">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>


        
        <div class="form-actions form-group">
        	          <button type="submit" class="btn btn-primary btn-sm">Create Vendor</button>
        </div>

    </fieldset>
</form>




</div>
</div>









      	
      	
     


@stop