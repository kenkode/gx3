<?php
	function asMoney($value) {
	  return number_format($value, 2);
	}
?>

@extends('layouts.accounting')
@section('content')

<style>
	
	.top-header{
		background: #E1F5FE !important;
		color: #777;
		vertical-align: middle !important;
		padding: 10px 5px !important;
		text-align: center;
	}

	div.head{
		display: inline-block;
		width: 49%;
		margin-right: 0px;
		padding: 0 !important;
	}

	div.left{
		display: inline-block;
		text-align: center;
		border-right: 1px solid #ccc !important;
	}

	h5{
		margin: 4px 10px 5px 10px !important;
	}

	h6{
		margin: 5px 10px 4px 10px !important;
	}

</style>


<!-- CHECK IF A PETTY CASH ACCOUNT EXISTS, ELSE CREATE ONE -->
@if(count($petty_account) > 0)

<!-- ADD MONY TO PETTY CASH FROM ASSET ACCOUNT -->
<div id="receiveMoney" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ URL::to('petty_cash/addMoney') }}" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title"><font color="green">Transfer Funds to Petty Cash Account</font></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>From:</label>
						<select class="form-control input-sm" name="ac_from" required>
							<option value="">--- Select an account ---</option>
							@if(count($assets) > 0)
							@foreach($assets as $asset)
								<option value="{{ $asset->id }}">{{ $asset->code }} - {{ $asset->name }} - (Balance: KES. {{ $asset->balance }})</option>
							@endforeach
							@endif
						</select>
					</div>

					<div class="form-group">
						<label>To (Petty Cash): </label>
						<select class="form-control input-sm" name="ac_to" required>
							<option value="">--- Select an account ---</option>
							@if(count($assets) > 0)
							@foreach($assets as $asset)
								<option value="{{ $asset->id }}">{{ $asset->code }} - {{ $asset->name }}</option>
							@endforeach
							@endif
						</select>
					</div>

					<div class="form-group">
			         <label>Transfer Amount:</label> 
			         <div class="input-group">
			            <span class="input-group-addon">KES</span>
			            <input type="text" class="form-control input-sm" name="amount" placeholder="{{ asMoney(0) }}" required>
			         </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>&emsp;
					<input type="submit" class="btn btn-primary btn-sm" value="Receive Money">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ./END -->


<!-- ADD MONEY TO PETTY CASH FROM OWNER'S CONTRIBUTION ACCOUNT -->
<div id="receiveContribution" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ URL::to('petty_cash/addContribution') }}" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title"><font color="green">Owner's Contribution to Petty Cash</font></h4>
					<p><font color="red">Please create owner's contribution account first as a liability.</font></p>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>From:</label>
						<select class="form-control input-sm" name="cont_acFrom" required>
							<option value="">--- Select an account ---</option>
							@if(count($liabilities) > 0)
							@foreach($liabilities as $liability)
								<option value="{{ $liability->id }}">{{ $liability->code }} - {{ $liability->name }}</option>
							@endforeach
							@endif
						</select>
					</div>

					<div class="form-group">
						<label>To:</label>
						<select class="form-control input-sm" name="cont_acTo" required>
							<option value="">--- Select an account ---</option>
							@if(count($assets) > 0)
							@foreach($assets as $asset)
								<option value="{{ $asset->id }}">{{ $asset->code }} - {{ $asset->name }}</option>
							@endforeach
							@endif
						</select>
					</div>
					
					<div class="form-group">
						<label>Contributor's Name:</label>
						<input type="text" name="cont_name" class="form-control input-sm" placeholder="Contributor's Name" required>
					</div>

					<div class="form-group">
			         <label>Transfer Amount:</label> 
			         <div class="input-group">
			            <span class="input-group-addon">KES</span>
			            <input type="text" class="form-control input-sm" name="cont_amount" placeholder="{{ asMoney(0) }}" required>
			         </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>&emsp;
					<input type="submit" class="btn btn-primary btn-sm" value="Receive Money">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ./END -->


<!-- NEW PETTY CASH TRANSACTION -->
<div id="newTransaction" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ URL::to('petty_cash/newTransaction') }}" method="POST">
				<input type="hidden" name="credit_ac" value="{{ $petty_account->id }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title"><font color="green">New Transaction - Receipt Details</font></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Receipt from (Where the Money was used) :</label>
						<input type="text" class="form-control input-sm" name="transact_to" placeholder="Transact To" required>
					</div>
					
					<div class="form-group">
						<label>Spending Account (Petty Cash) <span style="color:red">*</span> :</label>
						<select class="form-control input-sm" name="expense_ac" required>
							<option value="">--- Select an account ---</option>
							@if(count($assets) > 0)
							@foreach($assets as $asset)
								<option value="{{ $asset->id }}">{{ $asset->code }} - {{ $asset->name }}</option>
							@endforeach
							@endif
						</select>
					</div>

					<div class="form-group">
						<label for="username">Date:</label>
		            <div class="right-inner-addon ">
		            	<i class="fa fa-calendar"></i>
		            	<input class="form-control input-sm datepicker21" readonly="readonly" type="text" name="tr_date" value="{{ date('Y-m-d') }}" required>
		            </div>
					</div>

					<div class="form-group">
						<label>Description (Transaction Description) <span style="color:red">*</span>:</label>
						<textarea class="form-control input-sm" name="description" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>&emsp;
					<input type="submit" class="btn btn-primary btn-sm" value="Create">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ./END -->


<div class="row">
	<div class="col-lg-12">
		<h4><font color="green">Petty Cash</font></h4>
		<hr>
	</div>
</div>

<!-- ERROR MESSAGE -->
@if(Session::has('error'))
<div class="alert alert-danger fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Error! </strong>&emsp;{{ Session::get('error') }}<br>
   {{ Session::forget('error') }}
</div>
@endif

<!-- SUCCESS MESSAGE -->
@if(Session::has('success'))
<div class="alert alert-success fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success! </strong>&emsp;{{ Session::get('success') }}<br>
   {{ Session::forget('success') }}
</div>
@endif


<div class="row">
	<!-- HEADER INFO -->
	<div class="col-lg-12">
		<div class="top-header">
			<div class="head text-left"> 
				<div class="left">
					<h5><font color="#0BAEED">Petty Cash</font></h5>
					<h6>Account</h6>
				</div>
				<div class="left">
					<h5><font color="#0BAEED">Account Balance</font></h5>
					<h6>KES: {{ asMoney($petty_account->balance) }}</h6>
				</div>
			</div>
			<div class="head text-left">
				<div class="right">
					<div class="pull-right">
						<a href="#receiveMoney" class="btn btn-success btn-sm" data-toggle="modal">Transfer From</a></li>&emsp;
						<a href="#receiveContribution" class="btn btn-info btn-sm" data-toggle="modal">Receive Money</a></li>&emsp;
						<a href="#newTransaction" class="btn btn-warning btn-sm" data-toggle="modal"><i class="fa fa-plus fa-fw"></i>New Transaction</a></li>
	            </div>
				</div>
			</div>
		</div><hr>
	</div>

	<!-- BODY INFO -->
	<div class="col-lg-12">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#reconcile">Account Transactions</a></li>
		</ul>

		<div class="tab-content">
			<div id="reconcile" class="tab-pane fade in active">
				<table class="table table-condensed table-bordered table-responsive table-hover users">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Description</th>
							<th>Reference</th>
							<th>Spent</th>
							<th>Received</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $count=1; ?>
						@if(count($ac_transactions) > 0)
						@foreach($ac_transactions as $transaction)
						<tr>
							<td>{{ $count }}</td>
							<td>{{ $transaction->transaction_date }}</td>
							<td>{{ $transaction->description }}</td>
							<td></td>
							@if($transaction->account_credited == $petty_account->id)
								<td>{{ $transaction->transaction_amount }}</td>
								<td></td>
							@elseif($transaction->account_debited == $petty_account->id)
								<td></td>
								<td>{{ $transaction->transaction_amount }}</td>
							@endif
							<td>
								<div class="btn-group">
			                  <a href="{{URL::to('petty_cash/transaction/'.$transaction->id)}}" class="btn btn-info btn-sm">View</a>
			               </div>
							</td>
						</tr>
						<?php $count++; ?>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

@else
<div class="row">
	<div class="col-lg-12">
		<h4><font color="red">NO PETTY CASH ACCOUNT AVAILABLE PLEASE CREATE ONE!!! (AS AN ASSET ACCOUNT)</font></h4>
	</div>
	<div class="col-lg-12">
		<a href="{{ URL::to('accounts/create') }}" class="btn btn-primary btn-sm">Create Account</a>
	</div>
</div>
@endif


@stop