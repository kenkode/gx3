@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Tax</h3>

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

		 <form method="POST" action="{{{ URL::to('taxes') }}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
            <label for="username">Name (e.g. VAT):<span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Rate (% e.g. 5):<span style="color:red">*</span> :</label></label>
            <input class="form-control" placeholder="" type="text" name="rate" id="rate" value="{{{ Input::old('rate') }}}" required>
        </div>


        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Tax</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop