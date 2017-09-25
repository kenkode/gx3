@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Update Vehicle</h4>

<hr>
</div>	
</div>
<font color="red"><i>All fields marked with * are mandatory</i></font>

<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('vehicles/update/'.$vehicle->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Registration Number <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="reg_no" id="reg_no" value="{{$vehicle->reg_no}}">
        </div>

         <div class="form-group">
            <label for="username">Model:</label>
            <input class="form-control" placeholder="" type="text" name="model" id="model" value="{{$vehicle->model}}">
        </div>

        <div class="form-group">
            <label for="username">Fuel Tank Capacity:</label>
            <input class="form-control" placeholder="" type="text" name="tank_capacity" id="tank_capacity" value="{{$vehicle->tank_capacity}}">
        </div>

        
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-info btn-sm">Update Vehicle</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop