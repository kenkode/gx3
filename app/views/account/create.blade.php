@extends('layouts.erp')
@section('content')

	
<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Account</h3>

<hr>
</div>	
</div>
<font color="red"><i>All fields marked with * are mandatory</i></font><br>

<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif




		<form class="form-group" method="post" action="{{ URL::to('account')}}">



		<div class="form-group">

		<fieldset>

				<div class="form-group">

					<div class="form-group">
            			<label for="username">Name: <span style="color:red">*</span> :</label>
            			<input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
              			
				</div>
			

			<div class="form-group">
				<label for ="username">Description:</label> 
				<input type="text" placeholder="" name="description" class="form-control" value="{{{ Input::old('description') }}}">
			</div>

          

          <div class="form-group">
				<label for="username">Category:</label>
					

						
						<select name="category" id="status" class=" form-control">


							<option>..........................Select Account Category..............</option>

							
							<option value="cash">Cash</option>
							<option value="mobile">Mobile</option>
							<option value="bank">Bank</option>
						
						</select>
				
			</div>

      

		<div class="form-group">
				<label for = "username">Balance</label> 
				
					<div class="input-group">
						<span class="input-group-addon">KES</span>
						<input type="text" class="form-control"  id="balance" name="balance" value="{{{ Input::old('balance') }}}">
					
       <script type="text/javascript">

		$("#balance").keyup(function() {
    var val = $("#balance").val();
    if(parseInt(val) < 0 || isNaN(val)) {
    alert("please enter valid values");
        $("#balance").val("");
        $("#balance").focus();
    }
});

</script>

					</div>																			
				</div>
		

       <div class="form-group">
            <label class="control-label col-md-4">Active</label>
            <input   type="checkbox" name="confirmed" id="confirmed" value="1">
        </div>
        
			<div class="form-actions clearfix"> <input type="submit" value="Create Account" class="btn btn-primary"> </div>

	</fieldset>
		</form>



	</div>	

</div>


           
@stop