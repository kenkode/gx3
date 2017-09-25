@extends('layouts.payroll')
<script type="text/javascript">
 function totalBalance() {
      var instals = document.getElementById("instalments").value;
      var amt = document.getElementById("amount").value;
      var total = (instals * amt);
      document.getElementById("balance").value = total;
}

</script>

@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Employee Deduction</h3>

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

		 <form method="POST" action="{{{ URL::to('employee_deductions/update/'.$ded->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                        <label for="username">Employee <span style="color:red">*</span></label>
                        <select name="employee" class="form-control">
                            <option></option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"<?= ($ded->employee_id==$employee->id)?'selected="selected"':''; ?>> {{ $employee->first_name.' '.$employee->last_name }}</option>
                            @endforeach

                        </select>
                
                    </div>


        <div class="form-group">
         <label for="username">Deduction Type <span style="color:red">*</span></label>
                        <select name="deduction" class="form-control">
                           <option></option>
                            @foreach($deductions as $deduction)
                            <option value="{{ $deduction->id }}"<?= ($ded->deduction_id==$deduction->id)?'selected="selected"':''; ?>> {{ $deduction->deduction_name }}</option>
                            @endforeach
                        </select>
                
        </div>          

         <div class="form-group">
                        <label for="username">Formular <span style="color:red">*</span></label>
                        <select name="formular" class="form-control forml">
                            <option></option>
                            <option value="One Time"<?= ($ded->formular=='One Time')?'selected="selected"':''; ?>>One Time</option>
                            <option value="Recurring"<?= ($ded->formular=='Recurring')?'selected="selected"':''; ?>>Recurring</option>
                            <option value="Instalments"<?= ($ded->formular=='Instalments')?'selected="selected"':''; ?>>Instalments</option>
                        </select>
                
                    </div>

        <div class="form-group insts">
            <label for="username">Instalments </label>
            <input class="form-control" placeholder="" onkeypress="totalBalance()" onkeyup="totalBalance()" type="text" name="instalments" id="instalments" value="{{ $ded->instalments}}">
        </div>
        
        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" onkeypress="totalBalance()" onkeyup="totalBalance()" type="text" name="amount" id="amount" value="{{ $ded->deduction_amount}}">
        </div>
        
        <div class="form-group bal_amt">
            <label for="username">Total </label>
            <input class="form-control" placeholder="" readonly="readonly" type="text" name="balance" id="balance" value="{{ $ded->balance_amount}}">
        </div>
        
        <div class="form-group">
                        <label for="username">Deduction Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker" readonly="readonly" placeholder="" type="text" name="ddate" id="ddate" value="{{ $ded->deduction_date}}">
                        </div>
        </div>

        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Employee Deduction</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop