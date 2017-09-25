@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Sales Order</h3>

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

		 <form method="POST" action="{{{ URL::to('erporders/create') }}}" accept-charset="UTF-8">
   
    <fieldset>
        
         <div class="form-group">
            <label for="username">Order Number:</label>
            <input type="text" name="order_number" value="{{$order_number}}" class="form-control" readonly>
        </div>

        <div class="form-group">
                        <label for="username">Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{date('d-M-Y')}}">
                        </div>
          </div>


          <div class="form-group">
            <label for="username">Client <span style="color:red">*</span> :</label>
            <select name="client" class="form-control">
                @foreach($clients as $client)
                @if($client->type == 'Customer')
                    <option value="{{$client->id}}">{{$client->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="username">Sale Type <span style="color:red">*</span> :</label>
            <select name="payment_type" class="form-control">
                
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                    
            </select>
        </div>

        

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop