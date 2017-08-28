@extends('layouts.erp')
@section('content')

<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>

<br><div class="row">
	<div class="col-lg-12">
  <h3>Edit Account</h3>

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



		<form class="form-horizontal" method="post" action="{{ URL::to('account/update/'.$account->id)}}">	

			

		<div class="form-group">
				<label for="username">Name: <span style="color:red">*</label> 
				<input type="text" name="name" class="form-control" value="{{$account->name}}">
			</div>
			

			<div class="form-group">
				<label for="username">Description: </label> 
				<textarea class="form-control" name="description">{{$account->description}}</textarea>
			</div>
		


			<div class="form-group">
				<label for="username">Category: </label>
					

						
						<select name="category" id="status" class=" form-control">


							<option value="{{$account->category}}">{{$account->category}}</option>

							
							<option value="cash">Cash</option>
							<option value="mobile">Mobile</option>
							<option value="bank">Bank</option>
						
						</select>
					
			</div>

			
			<div class="form-group">
				<label for="username">Balance: <span style="color:red">*</label> 
				
					<div class="input-group">
						<span class="input-group-addon">KES</span>
						<input type="text" class="form-control"  id="balance" name="balance" value="{{asMoney($account->balance)}}">
					
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
	            <label class="control-label col-md-4">Active</label>&nbsp;&nbsp;
	            @if($account->confirmed)
	            <input   type="checkbox" name="confirmed" id="confirmed" value="1" checked>
	            @endif

	            @if(!$account->confirmed)
	            <input   type="checkbox" name="confirmed" id="confirmed" value="1">
	            @endif

        </div>

			



			<div class="form-actions clearfix"> <input type="submit" value="Save Changes" class="btn btn-primary"> </div>


		</form>



	</div>	

</div>


           
@stop