<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.erp')

{{ HTML::script('media/js/jquery.js') }}

<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>

@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4><font color='green'>Quote Number : {{$order->order_number}} &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client: {{$order->client->name}}  &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Date: {{$order->date}} &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Status: {{$order->status}} </font> </h4>

<hr>
</div>	
</div>

<div class="row">
    <div class="col-lg-12">
    <!-- <a href="#" class="btn btn-primary"> Generate Invoice</a> -->
    <a href="{{URL::to('erpReports/quotation/'.$order->id)}}" class="btn btn-primary" target="blank"> View Quotation</a>
    <a href="{{URL::to('erpReports/invoice/'.$order->id)}}" class="btn btn-primary" target="blank"> Generate Invoice</a>
    </div>
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

    <table class="table table-condensed table-bordered table-hover" >

     <thead>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total Amount</th>
        <th>Customer Discount</th>
        <th>Payable Amount</th>
        <th></th>
    </thead>

    <tbody>

   
        <?php $total = 0; 
         
        ?>
        @foreach($order->erporderitems as $orderitem)

            <?php
            $discount_amount = $orderitem['client_discount'];
            $total_amount = $orderitem['price'] * $orderitem['quantity'];
            $amount = $orderitem['price'] * $orderitem['quantity']-$discount_amount;
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $amount;
            
            ?>
        <tr>
            <!-- <td><input type="checkbox" class="checkbox" name="{{$orderitem->item->id}}" value=""></td> -->
            <td>{{$orderitem->item->name}}</td>
            <td>{{$orderitem['quantity']}}</td>
            <td>{{asMoney($orderitem['price'])}}</td>
            <td>{{asMoney($total_amount)}}</td>
            <td>{{asMoney($orderitem['client_discount'])}}</td>
            <td>{{asMoney($amount) }}</td>
            
        </tr>

        @endforeach

        <!-- <tr>
           <td></td>
            <td></td>
            <!-- <td></td>
            <td></td> -->
           <!--  <td></td>
            <td><strong><font color = "red">Grand Total</strong></font></td>
            <td><strong><font color = "red">{{asMoney($total)}}</strong></font></td>
          
        </tr> --> 
    </tbody>
        
    </table>
		

  </div>

</div>




@stop