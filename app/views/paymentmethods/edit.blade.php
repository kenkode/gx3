@extends('layouts.erp')
@section('content')

<br><div class="row">
    <div class="col-lg-12">
  <h3>Update Payment Method</h3>

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

         <form method="POST" action="{{{ URL::to('paymentmethods/update/'.$paymentmethod->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Payment Method <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{ $paymentmethod->name }}" required>
        </div>

        <div class="form-group">
            <label for="username">Account</label><span style="color:red">*</span> :
           <select name="account" class="form-control" required>
                           <option></option>
                           @foreach($accounts as $account)
                            <option value="{{$account->id }}"<?= ($paymentmethod->account_id==$account->id)?'selected="selected"':''; ?>> {{ $account->name }}</option>
                           @endforeach
                        </select>
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop