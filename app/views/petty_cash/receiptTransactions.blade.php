<?php
	function asMoney($value){
		return number_format($value, 2);
	}
?>

@extends('layouts.accounting')
@section('content')

<style type="text/css" media="screen">
	td.total{
		border-bottom: 3px double #777 !important;
		font-weight: bold !important;
	}	

</style>

<div class="row">
	<div class="col-lg-12">
		<h4><font color="green">Receipt Transactions</font></h4>
		<hr>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		@if(count($items) > 0)
			<table class="table table-condensed table-bordered table-responsive table-hover">
				<thead>
					<th>#</th>
					<th>Item</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Total Amount</th>
				</thead>
				<tbody>
					<?php $count = 0; $itemTotal = 0; $grandTotal = 0; ?>
					@foreach($items as $trItem)
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
						</tr>
						<?php $count++; ?>
					@endforeach
					<tr>
						<td colspan="4"></td>
						<td class="total">Grand Total</td>
						<td class="total">{{ $grandTotal }}</td>
					</tr>
				</tbody>
			</table>
		@else
			<h4><font color="red">This is a single transaction. No receipt</font></h4>
		@endif
	</div>
</div>

@stop