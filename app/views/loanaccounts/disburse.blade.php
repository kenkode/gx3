@extends('layouts.accounting')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Loan Disbursal</h3>

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

<table class="table table-bordered table-condensed">

  <tr>
    <td>Amount Approved</td> <td>{{ $loanaccount->amount_approved}}</td>
  </tr>
  <tr>
    <td>Period Approved</td> <td>{{ $loanaccount->period.' months'}}</td>
    </tr>
  <tr>
    <td>Interest Rate </td> <td>{{ $loanaccount->interest_rate.' %'}}</td>

  </tr>

</table>
       

		 <form method="POST" action="{{{ URL::to('loans/disburse/'.$loanaccount->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

      <input class="form-control" placeholder="" type="hidden" name="loanaccount_id" id="loanaccount_id" value="{{ $loanaccount->id }}">
         
        <input class="form-control" placeholder="" type="hidden" name="loanproduct_id" id="loanproduct_id" value="{{ $loanaccount->loanproduct->id }}">

        <div class="form-group">
            <label for="username">Disbursal Date </label>
            <input class="form-control" placeholder="" type="date" name="date_disbursed" id="date_disbursed" value="{{ date('Y-m-d') }}">
        </div>



        <div class="form-group">
            <label for="username">Amount Disbursed</label>
            <input class="form-control" placeholder="" type="text" name="amount_disbursed" id="amount_disbursed" value="{{ $loanaccount->amount_approved }}">
        </div>

         <div class="form-group">
            <label for="username">Repayment Start Date </label>
            <input class="form-control" placeholder="" type="date" name="repayment_start_date" id="repayment_start_date" value="{{ date('Y-m-d') }}">
        </div>
         
        


        
      
        
        <div class="form-actions form-group">
        
        

          <button type="submit" class="btn btn-primary btn-sm">Disburse Loan</button> 
        </div>

    </fieldset>
</form>

  
  </div>

</div>











<!-- organizations Modal -->
<div class="modal fade" id="schedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Loan Schedule</h4>
      </div>
      <div class="modal-body">


        
        



        
      </div>
      <div class="modal-footer">
        
        <div class="form-actions form-group">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        
        </div>

      </div>
    </div>
  </div>
</div>














@stop