@extends('layouts.system')
@section('content')
<br/><br/>

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-12">

	@if (Session::get('error'))
            <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
        @endif

<p>Bulk Import Savings</p>
<hr>

<br>
</div>	


<div class="col-lg-5 ">

	
<form method="POST" action="{{{ URL::to('savingtransactions/import') }}}"  enctype="multipart/form-data">
 


		<div class="form-group">
            <label for="username">File (csv) </label>
            <input type="file" name="saving" id="saving" >
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Upload & Import</button>
        </div>


</form>	

</div>	



</div>


@stop