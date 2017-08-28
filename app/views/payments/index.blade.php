<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
@extends('layouts.erp')
@section('content')


<div class="row">
	<div class="col-lg-12">
  <h4>Payments</h4>

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
    
    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('payments/create')}}">new payment</a>&emsp;
          <a class="btn btn-primary btn-sm" href="{{ URL::to('daily_payments/today') }}">Daily Payments</a>
      </div>
      <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Client</th>
        <th>Amount</th>
        <!-- <th>Balance</th> -->
        <th>Date</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($payments as $payment)

        <tr>

          <td> {{ $i }}</td>
          
       
          <td>{{ $payment->client->name }}</td>
           
          <td align="right">{{ asMoney($payment->amount_paid) }}</td>
          <!-- <td></td> -->
          <td>{{ date("d-M-Y",strtotime($payment->payment_date)) }}</td>
          <td>


            

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('payments/edit/'.$payment->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('payments/delete/'.$payment->id)}}"  onclick="return (confirm('Are you sure you want to delete this payment?'))">Delete</a></li>
                    
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