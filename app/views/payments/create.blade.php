<?php session_start(); 
function asMoney($value) {
  return number_format($value, 2);
}

?>

{{HTML::script('media/jquery-1.8.0.min.js') }}

@extends('layouts.erp')

<script type="text/javascript">
$(document).ready(function() {
  
    $('#order').change(function(){
     
        $.get("{{ url('api/total')}}", 
        { option: $(this).val() }, 
        function(data) {
          console.log('hi');
                $('#amountdue').val(data);
            });
        });
   });
</script>

@section('content')

<br><div class="row">
  <div class="col-lg-12">
  <h4>Payment Details</h4>
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

     <form method="POST" action="{{{ URL::to('payments') }}}" accept-charset="UTF-8">
   
    <font color="red"><i>All fields marked with * are mandatory</i></font>
    <fieldset>
      
        
        <div class="form-group">
            <label for="username">Client Name</label><span style="color:red">*</span> :
           <select name="order" id="order" class="form-control" required>
                           <option></option>
                           <option>..................................Select Client....................................</option>
                           @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                           @endforeach
                        </select>
        </div>

        <!-- <div class="form-group">
            <label for="username">Amount To Be Paid<span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="amounttopay" id="amounttopay" value="{{{ Input::old('amount') }}}">
        </div> -->

       <!--  <div class="form-group">
            <label for="username">Amount Due :</label>
            <input class="form-control" placeholder="" type="text" name="withstandingamount" id="withstandingamount" value="{{{ Input::old('withstandingamount') }}}">
        </div> -->

        <div class="form-group">
        <label for="username">Amount Due</label> 
        
          <div class="input-group">
            <span class="input-group-addon">KES</span>
            <input type="text" class="form-control"  name="amountdue" id="amountdue" value= '{{asMoney(0.00)}}' readonly> 
        </div>
      </div>

        <div class="form-group">
            <label for="username">Payment Amount<span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{{ Input::old('amount') }}}" required>
        </div>


        <div class="form-group">
            
            <input class="form-control" placeholder="" type="hidden" name="credit_account" id="credit_account" value="2">
        </div>

         <div class="form-group">
            
            <input class="form-control" placeholder="" type="hidden" name="description" id="description" value="{{{ Input::old('description') }}}">
        </div>

        

      <hr>



        <div class="form-group">
            <label for="username">Payment Method</label><span style="color:red">*</span> :
           <select name="paymentmethod" class="form-control" required>
                          <option></option>
                           <option>......................Select Payment Method......................</option>
                           @foreach($paymentmethods as $paymentmethod)
                            <option value="{{$paymentmethod->id}}">{{$paymentmethod->name}}</option>
                           @endforeach
                        </select>
        </div> 

        <div class="form-group">
            <label for="username">Account</label><span style="color:red">*</span> :
           <select name="account" class="form-control" required>
                          <option></option>>
                           <option>...............................Select Account...........................</option>
                           @foreach($accounts as $account)
                            <option value="{{$account->id}}">{{$account->name}}</option>
                           @endforeach
                        </select>
        </div>       

        
            <input class="form-control" placeholder="" type="hidden" readonly="readonly" name="received_by" id="received_by" value="{{{ Confide::user()->username}}}">
        
         <div class="form-group">
                        <label for="username">Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="pay_date" id="pay_date" value="{{date('d-M-Y')}}" required>
                        </div>
          </div>



          
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Accept Payment</button>
        </div>

    </fieldset>
</form>
    

  </div>

</div>

@stop