@extends('layouts.charge')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Charge</h3>

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

		 <form method="POST" action="{{{ URL::to('charges/update/'.$charge->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
            <label for="username">Charge Category</label>
          <select class="form-control" name="category" id="category">
              <option value="{{ $charge->category }}">{{ $charge->category }}</option>
            <option></option>
            <option value="loan">Loan</option>
            <option value="saving">Saving</option>
            <option value="share">Share</option>
          </select>
        </div>
        

        <div class="form-group">
            <label for="username">Charge Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{ $charge->name }}">
        </div>


         <div class="form-group">
            <label for="username">Calculation Method</label>
          <select class="form-control" name="calculation_method" id="calculation_method">
            <option value="{{ $charge->calculation_method }}">{{ $charge->calculation_method }}</option>
            <option></option>
            <option value="flat">Flat</option>
            <option value="percent">Percentage</option>
            
          </select>
        </div>

         <div class="form-group">
            <label for="username">Payment Method</label>
          <select class="form-control" name="payment_method" id="payment_method">
             <option value="{{ $charge->payment_method }}">{{ $charge->payment_method }}</option>
            <option></option>
            <option value="regular">Regular</option>
            <option value="account">Account Transfer</option>
            
          </select>
        </div>
        
         <div class="form-group">
            <label for="username">Percentage of</label>
          <select class="form-control" name="percentage_of" id="percentage_of">
              <option value="{{ $charge->percentage_of }}">{{ $charge->percentage_of }}</option>
            <option></option>
            <option value="transactionAmount">Transaction Amount</option>
            <option value="loan">Loan</option>
          </select>
        </div>
        
        
        
        
        <div class="form-group">
            <label for="username">Value/ Amount</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{$charge->amount}}">
        </div>
        

        <div class="form-group">
            <label for="username">is Fee</label>

            @if($charge->fee)
            <input  type="checkbox" name="fee" id="fee" value="1" checked>
            @endif


            @if(!$charge->fee)
            <input  type="checkbox" name="fee" id="fee" value="1">
            @endif
        </div>







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">update Charge</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop