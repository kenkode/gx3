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
	}	

	input[type='text']{
		width: 210px !important;
	}

	table{
		table-layout: fixed;
	}

	td.total{
		border-bottom: 3px double #777 !important;
		//text-decoration: underline;
		font-weight: bold !important;
	}

</style>

<div class="row">
	<div class="col-lg-12">
		<h4>
			<font color="green">Transaction Items</font>&emsp;|&emsp;
			<font color="green">Transact To:&nbsp;{{ $newTr['transactTo'] }}</font>&emsp;|&emsp;
			<font color="green">Date:&nbsp;{{ $newTr['trDate'] }}</font>
		</h4>
		<hr>
	</div>
</div>

<!-- INPUT FORM -->
<div class="row">
	<div class="col-lg-12">
		<div class="top-header">
			<form class="form-inline" action="{{ URL::to('petty_cash/newTransaction') }}" method="POST">
			<h5>Add Receipt Items</h5>
				<input type="hidden" name="transact_to" value="{{ $newTr['transactTo'] }}">
				<input type="hidden" name="tr_date" value="{{ $newTr['trDate'] }}">
				<input type="hidden" name="description" value="{{ $newTr['description'] }}">
				<input type="hidden" name="credit_ac" value="{{ $newTr['credit_ac'] }}">
				<input type="hidden" name="expense_ac" value="{{ $newTr['expense_ac'] }}">

				<div class="form-group">
					<label>Item <span style="color:red">*</span>:</label><br>
					<input type="text" class="form-control input-sm" name="item" placeholder="Item Name" required>
				</div>&emsp;&nbsp;

				<div class="form-group">
					<label>Description:</label><br>
					<input type="text" class="form-control input-sm" name="desc" placeholder="Item Description">
				</div>&emsp;&nbsp;

				<div class="form-group">
					<label>Quantity <span style="color:red">*</span>:</label><br>
					<input type="text" class="form-control input-sm" name="qty" placeholder="Item Quantity" required>
				</div>&emsp;&nbsp;

				<div class="form-group">
					<label>Unit Price <span style="color:red">*</span>:</label><br>
					<input type="text" class="form-control input-sm" name="unit_price" placeholder="Unit Price" required>
				</div>&emsp;&nbsp;

				<div class="form-group">
					<label>Submit</label><br>
					<input type="submit" class="btn btn-success btn-sm" name="itemSubmit" value="Add Item">
				</div>
			</form>
		</div>
		<hr>
	</div>

	<div class="col-lg-12">
		<div>
			<form action="{{URL::to('petty_cash/commitTransaction')}}" method="POST">
				<h4><font color="#40AEED">Receipt Items</font></h4>
				<table class="table table-condensed table-bordered table-responsive table-hover">
					<thead>
						<th>#</th>
						<th>Item</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total Amount</th>
						<th>Action</th>
					</thead>
					<tbody>
						@if(count($trItems) > 0)
						<?php $count = 0; $itemTotal = 0; $grandTotal = 0; ?>
						@foreach($trItems as $trItem)
							<?php 
								$itemTotal = $trItem['quantity'] * $trItem['unit_price']; 
								$grandTotal += $itemTotal;
							?>
							<tr>
								<td>{{ $count+1 }}</td>
								<td>{{ $trItem['item_name'] }}</td>
								<td>{{ $trItem['description'] }}</td>
								<td>{{ $trItem['quantity'] }}</td>
								<td>{{ $trItem['unit_price'] }}</td>
								<td>{{ $itemTotal }}</td>
								<td>
				               <div class="btn-group">
				                  <a href="{{URL::to('petty_cash/newTransaction/remove/'.$count)}}" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-times"></i></a>
				               </div>
								</td>
							</tr>
							<?php $count++; ?>
						@endforeach
						<tr>
							<td colspan="4"></td>
							<td class="total">Grand Total</td>
							<td class="total">{{ $grandTotal }}</td>
							<td></td>
						</tr>
						@endif
					</tbody>
				</table>
				<hr>
				<div class="form-group">
					<a href="{{ URL::to('petty_cash') }}" class="btn btn-danger btn-sm">Cancel</a>
					<div class="form-group pull-right">
						<input type="submit" class="btn btn-primary btn-sm" name="btnProcess" value="Process">
					</div>
				</div>
				<hr>
			</form>
		</div>
	</div>
</div>

@stop