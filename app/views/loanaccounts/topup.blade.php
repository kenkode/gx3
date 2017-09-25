@extends('layouts.accounting')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Loan Top Up</h3>

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


       

		 <form method="POST" action="{{{ URL::to('loanaccounts/topup/'.$loanaccount->id) }}}" accept-charset="UTF-8">
   
    <fieldset>


      

         


<?php $date = date('Y-m-d'); ?>
        <div class="form-group">
            <label for="username">Top up Date </label>
          <input class="form-control" placeholder="" type="date" name="top_up_date" id="application_date" value="{{$date}}">
        </div>


        <div class="form-group">
            <label for="username">Top Up Amount</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount_applied" value="{{{ Input::old('to_up_amount') }}}">
        </div>





        
        


        
      
        
        <div class="form-actions form-group">
        
        

          <button type="submit" class="btn btn-primary btn-sm">Submit</button> 
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