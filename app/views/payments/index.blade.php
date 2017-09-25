<?php
  function asMoney($value){
    return number_format($value, 2);
  }
?>

@extends('layouts.erp')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <h4><font color="green">Payments</font></h4>
    <hr>
  </div>
</div>

@if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif

<div class="row"> 
  <!-- QUICK LINK BUTTONS -->
  <div class="col-lg-12">
    <a href="{{ URL::to('payments/create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus fa-fw"></i> New Payment</a>&emsp;
    <!-- <a href="" class="btn btn-warning btn-sm"> Run Depreciation</a>&emsp; -->
    <a href="{{ URL::to('daily_payments/today') }}" class="btn btn-info btn-sm"> Daily Payment</a>&emsp;
    <hr>
  </div><!-- ./END -->

  <!-- FIXED ASSETS BODY SECTION -->
  <div class="col-lg-12">
    <!-- TAB LINKS -->

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#registeredAssets">Receivable </a></li>
      <li><a data-toggle="tab" href="#soldDisposedAssets">Payable </a></li>
    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content">
      <!-- REGISTERED ASSETS -->
      <div id="registeredAssets" class="tab-pane fade in active">
        <table class="table table-condensed table-bordered table-responsive table-hover users">
          <thead>
            <tr>
              <th>#</th>
              <th>Clent</th>
              <th>Amount</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @foreach($payments as $payment)
            @if($payment->client->type == 'Customer')

            <tr>
              <td>{{ $i }}</td>
              <td>{{ $payment->client->name }}</td>
              <td align="right">{{ asMoney($payment->amount_paid) }}</td>
              <td>{{ date("d-M-Y",strtotime($payment->date)) }}</td>
              
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
        @endif
        @endforeach

          </tbody>
        </table>
      </div><!-- ./End of registered assets -->
      
      <!-- SOLD/DISPOSED ASSETS -->
      <div id="soldDisposedAssets" class="tab-pane fade in">
        <!-- SOLD/DISPOSED ASSETS -->
        <table class="table table-condensed table-bordered table-responsive table-hover users">
          <thead>
            <tr>
              <th>#</th>
              <th>Clent</th>
              <th>Amount</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1; ?>
            @foreach($payments as $payment)
            @if($payment->client->type == 'Supplier')

            <tr>
              <td>{{ $i }}</td>
              <td>{{ $payment->client->name }}</td>
              <td>{{ asMoney($payment->amount_paid) }}</td>
              <td>{{ date("d-M-Y",strtotime($payment->date)) }}</td>
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
        @endif
        @endforeach

          </tbody>
        </table>
      </div><!-- ./End of disposed assets -->
    </div><!-- ./End of tab cotent -->

  </div><!-- ./End of body section -->

</div>

@stop