@extends('layouts.payroll')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Employee Earning</h3>

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

		 <form method="POST" action="{{{ URL::to('other_earnings') }}}" accept-charset="UTF-8">
   
    <fieldset>

       <div class="form-group">
                        <label for="username">Employee <span style="color:red">*</span></label>
                        <select name="employee" class="form-control">
                           <option></option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"> {{ $employee->first_name.' '.$employee->last_name }}</option>
                            @endforeach
                        </select>
                
                    </div>                    

         <div class="form-group">
                        <label for="username">Earning Type <span style="color:red">*</span></label>
                        <select name="earning" class="form-control">
                            <option></option>
                            <option value="Bonus">Bonus</option>
                            <option value="Commission">Commission</option>
                            <option value="Others">Others</option>
                        </select>
                
                    </div>


        <div class="form-group">
            <label for="username">Earning narrative </label>
            <input class="form-control" placeholder="" type="text" name="narrative" id="narrative" value="{{{ Input::old('narrative') }}}">
        </div>  

        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{{ Input::old('amount') }}}">
        </div>
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Employee Earning</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop