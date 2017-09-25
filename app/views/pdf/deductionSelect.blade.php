@extends('layouts.pay_ports')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Select Deduction</h3>

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

		 <form method="POST" action="{{URL::to('payrollReports/deductions')}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
                        <label for="username">Period <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker2" readonly="readonly" placeholder="" type="text" name="period" id="period" value="{{{ Input::old('period') }}}">
                    </div>
       </div>

            <div class="form-group">
                        <label for="username">Select:</label>
                        <select name="deduction" class="form-control">
                            <option></option>
                            @foreach($deds as $ded)
                            <option value="{{$ded->id}}"> {{ $ded->deduction_name }}</option>
                            @endforeach

                        </select>
                
            </div>

                        <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="sel">
                              Select All
                        </label>
                    </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Select</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop