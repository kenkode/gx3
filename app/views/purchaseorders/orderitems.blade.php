@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Sales Order : {{Session::get('erporder')['order_number']}} &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client: {{Session::get('erporder')['client']['name']}}  &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Date: {{Session::get('erporder')['date']}} </h4>

<hr>
</div>	
</div>


<br><div class="row">
    
  <form class="form-inline" method="post" action="{{URL::to('orderitems/create')}}">
      <div class="col-lg-12">

        <div class="form-group ">
            <label>Item</label>
            <select name="item" class="form-control">
            <option> ..... select sale item....</option>
                @foreach($items as $item)
                
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    
                @endforeach
            </select>
        </div>


        <div class="form-group ">
            <label>Quantity</label>
            <input type="text" name="quantity" class="form-control">
        </div>

        <!-- <div class="form-group ">
            <label>Duration( days/hours)</label>
            <input type="text" name="duration" class="form-control">
        </div> -->

        <div class="form-group ">
            
            <input type="submit"  class="btn btn-primary" value="Add Item">
        </div>


      </div> 


  </form>



</div>


<div class="row">
	<div class="col-lg-12">

    <hr>
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

    <table class="table table-condensed table-bordered">

    <thead>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <!-- <th>Amount</th> -->
        <!-- <th>Duration</th> -->
        <th>Total Amount</th>
        <th></th>
    </thead>

    <tbody>

   
        <?php $total = 0; ?>
        @foreach($orderitems as $orderitem)

            <?php

            $amount = $orderitem['price'] * $orderitem['quantity'];
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $amount;
            ?>
        <tr>
            <td>{{$orderitem['item']}}</td>
            <td>{{$orderitem['quantity']}}</td>
            <td>{{$orderitem['price']}}</td>
            <!-- <td>{{$amount}}</td> -->
            <!-- <td>{{$orderitem['duration']}}</td> -->
            <td>{{$amount }}</td>
            <td>
                <a href="{{URL::to('orderitems/remove/'.$orderitem['itemid'])}}">X</a>
            </td>
        </tr>

        @endforeach

        <tr>
           
            <td></td>
            <!-- <td></td> -->
            <!-- <td></td> -->
            <td></td>
            <td>Total</td>
            <td>{{$total}}</td>
            <td></td>
        </tr>
    </tbody>
        
    </table>
		

  </div>

</div>


<div class="row">
    <div class="col-lg-12">

    <hr>

    <a href="{{URL::to('erporder/commit')}}" class="btn btn-primary pull-right">Place Order</a>
    </div>
</div>

@stop