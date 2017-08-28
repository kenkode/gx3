<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>
@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Customer Discount</h4>

<hr>
</div>
</div>
	
</div>
<br>
<p>


<div class="row">
	<div class="col-lg-5">

    @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

    @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif

    
      
        


    <table  class="table table-condensed table-bordered table-responsive table-hover">

     <tr>
      <td colspan="2"><font color="green">Customer Discount</font></td>
    </tr>
     <tr>
       <td>Date</td><td>{{ $price->date }}</td>
     </tr>
      <tr>
       <td>Client Name</td><td>{{ $price->client->name }}</td>
     </tr>
     <tr>
       <td>Item</td><td>{{ Item::itemname($price->Item_id) }}</td>
     </tr>
     <tr>
       <td>Discount</td><td>{{ $price->Discount }}</td>
     </tr>  
    </table>
 </div> 

</div>

@stop