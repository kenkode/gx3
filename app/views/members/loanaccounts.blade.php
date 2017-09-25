@extends('layouts.member')
@section('content')
<br/>


<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>


<div class="row">
	<div class="col-lg-12">
  <h3>{{$member->name}} Loan Accounts</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('loans/apply/'.$member->id)}}">new Loan</a>
        </div>
        <div class="panel-body">


  
      <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Loan Type</th>
        <th>Loan Number</th>
      
        <th>Loan Amount</th>
        <th>Disbursed On</th>
    

        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($member->loanaccounts as $loan)

        @if($loan->is_disbursed == TRUE)
        <tr>

          <td> {{ $i }}</td>
          <td>{{ $loan->loanproduct->name }}</td>
          <td>{{ $loan->account_number }}</td>
         
          <td>{{ asMoney($loan->amount_applied) }}</td>
          <td>{{ $loan->date_disbursed }}</td>
          
          <td>
             <a href="{{ URL::to('loans/show/'.$loan->id) }}" class="btn btn-info btn-sm">Manage</a>

          </td>
                    

        </tr>

        <?php $i++; ?>

        @endif
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>
























@stop