@extends('layouts.member')
@section('content')
<br/>

<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

<div class="row">
	<div class="col-lg-5">
 
 <table class="table table-condensed table-bordered table-hover">

   <tr>
    <td>Member Name:</td><td>{{ $account->member->name}}</td>
</tr>
<tr>
    <td>Member No:</td><td>{{ $account->member->membership_no}}</td>
</tr>
<tr>
    <td>Account No:</td><td>{{ $account->account_number}}</td>
</tr>

<tr>
    <td>Total Shares:</td><td>{{ $shares }}</td>
</tr>

 </table>


</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    
		
		 <hr>

		

  </div>

</div>




<div class="row">
    <div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('sharetransactions/create/'.$account->id)}}"> New Transaction</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-striped table-responsive table-hover">


      <thead>

        
        <th>Date</th>
        <th>Description</th>
        <th>Debit (DR)</th>
         <th>Credit (CR)</th>
       
     

      </thead>
      <tbody>

      
        @foreach($account->sharetransactions as $transaction)

        <tr>

         
          <td>{{ $transaction->date }}</td>
          <td>{{ $transaction->description }}</td>

          @if( $transaction->type == 'debit')
          <td >{{ asMoney($transaction->amount)}}</td>
          <td>0.00</td>
          @endif

       @if( $transaction->type == 'credit')
       <td>0.00</td>
          <td>{{ asMoney($transaction->amount) }}</td>
          @endif

           



        </tr>

       
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>






















@stop