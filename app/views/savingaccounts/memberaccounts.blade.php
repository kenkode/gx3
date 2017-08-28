
@extends('layouts.main')



@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>{{$member->name}}</h3>
  <p>Saving Accounts</p>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
         @if(Confide::user()->user_type != 'teller')

                   <a class="btn btn-info btn-sm" href="{{ URL::to('savingaccounts/create/'.$member->id)}}">new Saving Account</a>
          @endif

          
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Member Name</th>
        <th>Savings Product</th>
        <th>Account Number</th>
         
        <th></th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($member->savingaccounts as $saving)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $saving->member->name }}</td>
          <td>{{ $saving->savingproduct->name }}</td>
          <td>{{ $saving->account_number }}</td>
         
           <td> <a href="{{ URL::to('savingtransactions/show/'.$saving->id)}}" class="btn btn-primary btn-sm">Transactions </a></td>
            <td> <a href="{{ URL::to('savingtransactions/create/'.$saving->id)}}" class="btn btn-primary btn-sm">Transact </a></td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>
























@stop