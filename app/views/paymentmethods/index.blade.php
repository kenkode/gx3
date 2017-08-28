@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Payment Methods</h3>

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
          <a class="btn btn-info btn-sm" href="{{ URL::to('paymentmethods/create')}}">new payment method</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Name</th>
        <th>Account</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($paymentmethods as $paymentmethod)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $paymentmethod->name }}</td>
          @if($paymentmethod->account_id != 0)
          <td>{{ $paymentmethod->account->name }}</td>
           @else
          <td></td>
          @endif
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('paymentmethods/edit/'.$paymentmethod->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('paymentmethods/delete/'.$paymentmethod->id)}}"  onclick="return (confirm('Are you sure you want to delete this payment method?'))">Delete</a></li>
                    
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