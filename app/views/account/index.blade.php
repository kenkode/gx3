@extends('layouts.erp')
@section('content')

<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>	
	
<br><div class="row">
  <div class="col-lg-12">
  <h3>Accounts List</h3>

<hr>
</div>  
</div>
	
<div class="row">

	<div class="col-lg-11">
		<div class="panel panel-default">
			<div class="panel-heading">
    			<a href="{{ URL::to('account/create')}}" class="btn btn-info btn-sm" >New account</a>

    			<a href="{{ URL::to('account/bank')}}" class="btn btn-info btn-sm">Transfer Money</a>
  			</div>
  			<div class="panel-body">

		
		<table id="users" class="table table-condensed table-bordered table-hover">

			<thead>

				<th>#</th>
				<th>Name</th>
				<th>Description</th>
				<th>Category</th>
				<th>Balance</th>
				<th>Active/Disabled</th>
				
				<th></th>
				<th></th>
				

			</thead>

			<tbody>

			     <?php $i = 1;?>
				 @foreach($account as $account)

					<tr>
						<td> {{$i++}}</td>
						<td> {{ $account->name }}</td>
						<td> {{ $account->description  }}</td>
						<td>{{ $account->category}}</td>
						<td>{{asMoney($account->balance) }} </td>
               			<td>
						@if($account->confirmed)

                        Active
                        @endif

                        @if(!$account->confirmed)

                        Disabled
                        @endif
						</td>
						<td>
							<a href="{{ URL::to('account/edit/'.$account->id)}}" class="btn btn-info btn-sm">Update</a>
						</td>
						<td>
							<a href="{{ URL::to('account/delete/'.$account->id)}}" class="btn btn-info btn-sm">Delete</a>
						</td>
		

					</tr>

				@endforeach

			</tbody>

		</table>

</div>
</div>

	</div>	

	

	
</div>
@stop