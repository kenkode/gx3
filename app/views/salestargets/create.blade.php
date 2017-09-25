@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>New Sales Target</h4>

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

		 <form method="POST" action="{{{ URL::to('salestargets') }}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
            <label for="username">Month:<span style="color:red">*</span> :</label>
            <div class="right-inner-addon ">
            <i class="glyphicon glyphicon-calendar"></i>
            <input class="form-control datepicker23" placeholder="" type="text" name="month" id="month" value="{{{ Input::old('month') }}}" required readonly="readonly">
            </div>
        </div>

        <div class="form-group">
            <label for="username">Target Amount:<span style="color:red">*</span> :</label></label>
            <input class="form-control" placeholder="" type="text" name="target_amount" id="target_amount" value="{{{ Input::old('target_amount') }}}" required>
        </div>

         <div class="form-group">
                        <label for="username">Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{date('Y-M-d')}}">
                        </div>
          </div>


        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Set Target</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop