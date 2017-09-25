@extends('layouts.charge')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Charge</h3>

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

		 <form method="POST" action="{{{ URL::to('charges') }}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
            <label for="username">Charge Category</label>
          <select class="form-control" name="category" id="category">
            <option></option>
            <option value="loan">Loan</option>
            <option value="saving">Saving</option>
            <option value="share">Share</option>
            <option value="member">member</option>
          </select>
        </div>
        

        <div class="form-group">
            <label for="username">Charge Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>


         <div class="form-group">
            <label for="username">Calculation Method</label>
          <select class="form-control" name="calculation_method" id="calculation_method">
            <option></option>
            <option value="flat">Flat</option>
            <option value="percent">Percentage</option>
             <option value="formula">Formula</option>
            
          </select>
        </div>

         <div class="form-group">
            <label for="username">Payment Time</label>
          <select class="form-control" name="payment_method" id="payment_method">
            <option></option>
            <option value="withdrawal">Withdrawal</option>
            <option value="transfer">Transfer</option>
            
          </select>
        </div>
        
         <div class="form-group">
            <label for="username">Percentage of</label>
          <select class="form-control" name="percentage_of" id="percentage_of">
            <option></option>
            <option value="transactionAmount">Transaction Amount</option>
            <option value="loan">Loan</option>
          </select>
        </div>
        
        
        
        
        <div class="form-group">
            <label for="username">Value/ Amount</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="0">
        </div>
        

        <div class="form-group">
            <label for="username">is Fee</label>
            <input  type="checkbox" name="fee" id="fee" value="1">
        </div>







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Charge</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop