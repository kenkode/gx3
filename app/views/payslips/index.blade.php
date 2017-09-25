@extends('layouts.payroll')

<script type="text/javascript">
function YNconfirm() { 
var per = document.getElementById("period").value;
 if (window.confirm('Do you wish to process payroll for '+per+'?'))
 {
   window.location.href = "{{ URL::to('payroll/accounts')}}";
 }
}
</script>

@section('content')
<br/>

<div class="row">
    <div class="col-lg-12">
  <h3>Period</h3>

<hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-5">
      @if (Session::has('success'))

      <div class="alert alert-success">
      {{ Session::get('success') }}
     </div>
    @endif

         <form method="POST" action="{{ URL::to('email/payslip/employees')}}" accept-charset="UTF-8">
   
    <fieldset>
       <div class="form-group">
                        <label for="username">Period <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker2" readonly="readonly" placeholder="" type="text" name="period" id="period" value="{{{ Input::old('period') }}}">
                    </div>
       </div>
        
        <div class="form-group">
                        <label for="username">Select Employee <span style="color:red">*</span></label>
                        <select name="employeeid" class="form-control">
                           <option></option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"> {{ $employee->personal_file_number.' '.$employee->first_name.' '.$employee->last_name }}</option>
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
        
          <button type="submit" class="btn btn-primary btn-sm" >Select</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop