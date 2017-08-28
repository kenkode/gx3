{{HTML::script('media/jquery-1.8.0.min.js') }}
@extends('layouts.erp')


<script type="text/javascript">
$(document).ready(function() {
  
    $('#driver_name').change(function(){
      
        $.get("{{ url('api/getcontact')}}", 
        { option: $(this).val() }, 
        function(data) {
            /*console.log('hi');*/
                $('#contact').val(data);
            });
        });
   });
</script>

<script type="text/javascript">
$(document).ready(function() {
  
    $('#reg_no').change(function(){
      
        $.get("{{ url('api/getmodel')}}", 
        { option: $(this).val() }, 
        function(data) {
            /*console.log('hi');*/
                $('#model').val(data);
            });
        });
   });
</script>

@section('content')

<br><div class="row">
	<div class="col-lg-10">
  <h4>Assign Driver</h4>

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

		 <form method="POST" action="{{{ URL::to('assigndrivers') }}}" accept-charset="UTF-8">
   
    <fieldset>


        <div class="form-group">
                        <label for="username">Date:<span style="color:red">*</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker21"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="" required>
                        </div>
          </div>

        <div class="form-group">
            <label for="username">Time Out:<span style="color:red">*</label>
            <input class="form-control" placeholder="" type="text" name="time_out" id="time_out" value="{{{ Input::old('time_out') }}}" required>
            
        </div>

       <div class="form-group">
            <label for="username">Driver Name:<span style="color:red">*</label>
            <select name="driver_name" id="driver_name" class="form-control" required>
                <option></option>
                 @foreach($drivers as $driver)
              <option value="{{$driver->id}}">{{$driver->surname.' '.$driver->first_name.' '.$driver->other_names}}</option>
              @endforeach
                
          </select>
        </div>

       <div class="form-group">
            <label for="username">Driver Contact:</label>
            <input class="form-control" placeholder="" type="text" name="contact" id="contact" value="{{{ Input::old('contact') }}}" readonly="readonly">
        </div>

        
        <div class="form-group">
            <label for="username">Vehicle Reg No:<span style="color:red">*</label>
            <select name="reg_no" id="reg_no" class="form-control" required>
                <option></option>

                @foreach($vehicles as $vehicle)
              <option value="{{$vehicle->id}}">{{$vehicle->reg_no}}</option>
              @endforeach
                
          </select>
        </div>

        <div class="form-group">
            <label for="username">Vehicle Model:<span style="color:red">*</label>
            <input class="form-control" placeholder="" type="text" name="model" id="model" value="{{{ Input::old('model') }}}" readonly="readonly" required>
        </div>

       <!--  <div class="form-group">
            <label for="username">Vehicle Model:<span style="color:red">*</label>
            <select name="model" id="model" class="form-control" required>
                <option></option>

                @foreach($vehicles as $vehicle)
              <option value="{{$vehicle->id}}">{{$vehicle->model}}</option>
              @endforeach
                
          </select>
        </div> -->

         <div class="form-group">
            <label for="username">Oil Level:<span style="color:red">*</label>
            <input class="form-control" placeholder="" type="text" name="oil_level" id="oil_level" value="{{{ Input::old('oil_level') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Water Level:<span style="color:red">*</label>
            <input class="form-control" placeholder="" type="text" name="water_level" id="water_level" value="{{{ Input::old('water_level') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Fuel Level:<span style="color:red">*</label>
            <input class="form-control" placeholder="" type="text" name="fuel_level" id="fuel_level" value="{{{ Input::old('fuel_level') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Tires(5th Spare) Pressure:<span style="color:red">*</label>
            <input class="form-control" placeholder="" type="text" name="tire_pressure" id="tire_pressure" value="{{{ Input::old('tire_pressure') }}}" required>
        </div>


        <div class="form-group">
            <label for="username">General Comments:</label>
            <textarea rows="5" class="form-control" name="general_comments" id="general_comments" value="{{{ Input::old('general_comments') }}}"></textarea>
        </div>       
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-info btn-sm">Save details</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop