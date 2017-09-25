@extends('layouts.savings')
@section('content')
<br/>

<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

<div class="row">
	<div class="col-lg-12">
  <h3>New Saving Product</h3>

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

		 <form method="POST" action="{{ URL::to('savingproducts') }}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Product Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}" required>
        </div>
        
      

        <div class="form-group">
            <label for="username">Product Short Name</label>
            <input class="form-control" placeholder="" type="text" name="shortname" id="shortname" value="{{{ Input::old('shortname') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Currency</label>
            <select class="form-control" name="currency" required>

                @foreach($currencies as $currency)
                <option value="{{ $currency->shortname }}"> {{ $currency->name }}</option>
                @endforeach
               


            </select>
        </div>


         <div class="form-group">
            <label for="username">Account opening balance</label>
            <input class="form-control" placeholder="" type="text" name="opening_balance" id="opening_balance" value="{{{ Input::old('opening_balance') }}}" required>
        </div>


         <div class="form-group">
            <label for="username">Cash Account</label>
            <select class="form-control" name="cash_account" required>

                <option></option>
                @foreach($accounts as $account)
                @if($account->category == 'ASSET')
                <option value="{{ $account->id }}">{{ $account->name."(".$account->code.")" }}</option>
                @endif
                @endforeach


            </select>
        </div>


        <div class="form-group">
            <label for="username">Savings Control Account</label>
            <select class="form-control" name="saving_control_acc" required>

                <option></option>
                @foreach($accounts as $account)
                @if($account->category == 'LIABILITY')
                <option value="{{ $account->id }}">{{ $account->name."(".$account->code.")" }}</option>
                @endif
                @endforeach


            </select>
        </div>

        <div class="form-group">
            <label for="username">Fee Income Account</label>
            <select class="form-control" name="fee_income_acc" required>

                <option></option>
                @foreach($accounts as $account)
                @if($account->category == 'INCOME')
                <option value="{{ $account->id }}">{{ $account->name."(".$account->code.")" }}</option>
                @endif
                @endforeach


            </select>
        </div>


        <div class="form-group">
            <label for="username">Product Type</label>
            <select class="form-control" name="type" required>

                <option></option>
               
                <option value="BOSA">BOSA</option>
                 <option value="FOSA">FOSA</option>

            </select>
        </div>
        

        
        <table class="table table-responsive table-bordered">

            <thead>
                <th></th>
                <th>Charge </th>
                <th>Amount</th>


            </thead>

            <tbody>
                @foreach($charges as $charge)




                @if($charge->category == 'saving')
                <tr>
                    <td><input type="checkbox" value="{{$charge->id}}" name="charge_id[]"></td>
                    <td>{{$charge->name}}</td>
                    <td>{{asMoney($charge->amount)}}</td>

                </tr>
                @endif




                @endforeach

            </tbody>

        </table>
        



        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Product</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop