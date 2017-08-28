@extends('layouts.accounting')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Journal Entry</h3>

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

		 <form method="POST" action="{{{ URL::to('journals') }}}" accept-charset="UTF-8">
   
    <fieldset>
        

        <div class="form-group">
                        <label for="username">Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{date('d-M-Y')}}">
                        </div>
          </div>





        
        <div class="form-group">
            <label for="username">Description</label>
            <textarea name="description" id="description" class="form-control"> </textarea>
        </div>

        <div class="form-group">
            <label for="username">Amount</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{{ Input::old('amount') }}}">
        </div>

        <div class="form-group">
            <label for="username">Debit Account</label>
            <select class="form-control" name="debit_account">

                <option></option>
                @foreach($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->name."(".$account->code.")" }}</option>
                @endforeach


            </select>
        </div>

        <div class="form-group">
            <label for="username">Credit Account</label>
            <select class="form-control" name="credit_account">

                <option></option>
                @foreach($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->name."(".$account->code.")" }}</option>
                @endforeach


            </select>
        </div>
        

        
        
        <input type="hidden" name="user" value="{{ Confide::user()->username }}">






        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Submit Entry</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop