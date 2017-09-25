@extends('layouts.earning')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Nssf Rate</h3>

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

		 <form method="POST" action="{{{ URL::to('nssf/update/'.$nrate->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Tier <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="tier" id="tier" value="{{ $nrate->tier}}">
        </div>

        <div class="form-group">
            <label for="username">Income From <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="i_from" id="i_from" value="{{ $nrate->income_from}}">
        </div>

        <div class="form-group">
            <label for="username">Income To <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="i_to" id="i_to" value="{{ $nrate->income_to}}">
        </div>

        <div class="form-group">
            <label for="username">Employee Amount<span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="employee_amount" id="employee_amount" value="{{ $nrate->ss_amount_employee}}">
        </div>

        <div class="form-group">
            <label for="username">Employer Amount <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="employer_amount" id="employer_amount" value="{{ $nrate->ss_amount_employer}}">
        </div>

        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Nssf Rate</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop