<?php 
	function asMoney($value){
		return number_format($value, 2);
	}
?>

@extends('layouts.erp')
@section('content')

<br>
<div class="row">
	<div class="col-lg-12">
		<h4>Clients with Balances</h4>
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
    			<h4>
            Clients with Balances &emsp;
            <a href="{{ URL::to('client/balances/report') }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-file fa-fw"></i> View PDF</a>
          </h4>
    		</div>

    		<div class="panel-body">
    			<table id="users" class="table table-bordered table-condensed table-responsive table-hover">
    				<thead>
    					<th>#</th>
    					<th>Name</th>
    					<!-- <th>Discount (%)</th> -->
              <th>Current</th>
              <th>1-30</th>
              <th>31-60</th>
              <th>61-90</th>
              <th>> 90</th>
    					<th>Total</th>
    				</thead>

    				<tbody>
    					<?php $count = 1; ?>
						@foreach($clients as $client)
						@if(Client::due($client->id) > 0)
						<tr>
							<td>{{ $count }}</td>
							<td>{{ $client->name }}</td>
							<!-- <td align="center">{{ asMoney($client->percentage_discount) }}</td> -->
              <td align="right"> {{ Client::dueToday($client->id)}} </td>
              <td align="right"> {{ Client::due30($client->id)}} </td>
              <td align="right"> {{ Client::due60($client->id)}} </td>
              <td align="right"> {{ Client::due90($client->id)}} </td>
              <td align="right"> {{ Client::due91($client->id)}} </td>
							<td align="right"> {{ Client::due($client->id)}} </td>
						</tr>
						<?php $count++ ?>
						@endif	
						@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
	</div>
</div>

@stop
