<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>
@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Customer Discounts</h4>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

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

    @if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('prices/create')}}">New Discount</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Date</th>
        <th>Client Name</th>
        <th>Item</th>        
        <th>Discount</th>         
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($prices as $price)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $price->date }}</td>
          <td>{{ $price->client->name }}</td>
          <td>{{ Item::itemname($price->Item_id) }}</td>
          <td>{{ $price->Discount }}</td>          
          
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('prices/edit/'.$price->id)}}">Update</a></li>
                    <li><a href="{{URL::to('prices/show/'.$price->id)}}">View Client</a></li>                    
                  </ul>
              </div>
              </td>

        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>

@stop