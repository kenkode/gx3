@extends('layouts.leave')
@section('content')
<div class="row">
	<div class="col-lg-12">
 

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('leavetypes') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Holiday Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>


        <div class="form-group">
            <label for="username">Days Entitled</label>
            <input class="form-control" placeholder="" type="text" name="days" id="days" value="{{{ Input::old('days') }}}">
        </div>
        

        
        
        
        

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
@stop


