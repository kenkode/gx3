@extends('layouts.leave')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Holiday</h3>

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

		 <form method="POST" action="{{{ URL::to('holidays/update/'.$holiday->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Holiday Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{ $holiday->name}}">
        </div>
        <div class="form-group">
                        <label for="username">Holiday Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{ $holiday->date}}">
                    </div>
       </div>
        
        
        
        

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Holiday</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop