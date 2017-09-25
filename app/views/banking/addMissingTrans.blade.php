@extends('layouts.accounting')
@section('content')

<!--
BEGINNING OF PAGE
-->
<div class="row">
	<div class="col-lg-12">
  		<h4><font color='green'>Add Missing Transactions and Reconcile </font></h4>
		<hr>
	</div>	
</div>

<div class="row">
	<div class="col-lg-5">
		<form action="{{ URL::to('bankAccount/reconcile/add/') }}" method="POST">
			<input type="hidden" name="bnk_trans_id" value="{{ $bnk_trans_id }}">
			<input type="hidden" name="bnk_stmt_id" value="{{ $bnk_stmt_id }}">
			<input type="hidden" name="ac_stmt_id" value="{{ $bookStmtID }}">
			<div class="form-group">
				<label>Transaction Description:</label>
				<textarea name="t_desc" class="form-control" required></textarea>
			</div>
			<div class="form-group">
				<label>Account Credited</label>
				<select name="ac_credited" class="form-control" required>
					<option value="">--- Account Credited ---</option>
					@foreach($accounts as $account)
						<option value="{{ $account->id }}">({{ $account->category }}) - {{ $account->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Account Debited</label>
				<select name="ac_debited" class="form-control" required>
					<option value="">--- Account Debited ---</option>
					@foreach($accounts as $account)
						<option value="{{ $account->id }}">({{ $account->category }}) - {{ $account->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Transaction Amount</label>
				<div class="input-group">
					<span class="input-group-addon">KES</span>
					<input type="text" class="form-control" name="t_amount" placeholder="Transaction amount">
				</div>
			</div>
			<div class="form-group pull-right">
				<input type="submit" class="btn btn-primary" name="btnAddTrans" value="Add & Reconcile">
			</div>
		</form>
	</div>
</div>

@stop