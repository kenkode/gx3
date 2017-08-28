@extends('layouts.savings')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>{{$savingproduct->name}}</h3>

<hr>
</div>	
</div>


<div class="row">

	<div class="col-lg-4">

    <table class="table table-bordered table-condensed table-hover">

      <tr>

        <td> Name</td><td>{{ $savingproduct->name}}</td>
      </tr>

      <tr>

        <td> Short name</td><td>{{ $savingproduct->shortname}}</td>
      </tr>

      <tr>

        <td> Opening Balance</td><td>{{ $savingproduct->opening_balance}}</td>
      </tr>


    </table>

</div>




<div class="col-lg-6">

    <table class="table table-bordered table-condensed table-hover">

      <tr>

        <td> Transaction</td><td>Debit Account</td><td>Credit Account</td>
      </tr>

      @foreach($savingproduct->savingpostings as $posting)
      <tr>

        <td> {{$posting->transaction }}</td>
        <td>

          <?php   

          $account = Account::findorfail($posting->debit_account);


           ?>
          {{ $account->name.'('.$account->code.')'}}</td>
        <td>

<?php   

          $account = Account::findorfail($posting->credit_account);


           ?>
          {{ $account->name.'('.$account->code.')'}}</td>
      </tr>

      @endforeach


    </table>

</div>



</div>


<div class="row">
  <div class="col-lg-7">

    <table class="table table-responsive table-condensed table-bordered">

      <thead>
          <th>Charge</th>
          <th>Amount</th>
          <th>Calculation</th>

      </thead>

      <tbody>
        @foreach($savingproduct->charges as $charge)
        <tr>
          <td>{{$charge->name }}</td>
          <td>{{$charge->amount }}</td>
          <td></td>
        </tr>
        @endforeach

      </tbody>

    </table>

  </div>

</div>






















@stop