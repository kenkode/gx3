<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>
@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Clients</h4>

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
          <a class="btn btn-info btn-sm" href="{{ URL::to('clients/create')}}">New Client</a> &emsp;
          <a class="btn btn-primary btn-sm" href="{{ URL::to('client/balances')}}">Client Balances</a>
      </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>Type</th>
        <!-- <th>Percentage Discount</th> -->
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($clients as $client)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $client->name }}</td>
          <td>{{ $client->phone }}</td>
          <td>{{ $client->email }}</td>
          <td>{{ $client->address }}</td>
          <td>{{ $client->type }}</td>
          <!-- <td>{{ asMoney($client->percentage_discount)}}%</td> -->
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('clients/edit/'.$client->id)}}">Update</a></li>
                    <li><a href="{{URL::to('clients/show/'.$client->id)}}">View Client</a></li>
                    <li><a href="{{URL::to('client/selectPeriod/'.$client->id)}}">View Statement</a></li>
                    <!--<li><a href="{{URL::to('erpReports/customerstatement/'.$client->id)}}" target="blank">View Statement</a></li>-->
                   <!--  <li><a href="{{URL::to('clients/delete/'.$client->id)}}"  onclick="return (confirm('Are you sure you want to delete this client?'))">Delete</a></li> -->
                    
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