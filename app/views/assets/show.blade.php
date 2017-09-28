<?php 
	function asMoney($value){
		return number_format($value, 2);
	}
?>

@extends('layouts.accounting')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h4><font color="green">Asset Details <small><strong>({{ $asset->asset_name }})</strong></small></font></h4>
		<hr>
	</div>
</div>

<div class="row">
	<h4 style="margin-left: 15px;"><font color="#0BAEED">Asset Details</font></h4>
	<div class="col-lg-4">
		<table class="table table-stripped table-condensed">
			<tr>
				<td><strong>Asset Name: </strong></td>
				<td>{{ $asset->asset_name }}</td>
			</tr>
			<tr>
				<td><strong>Asset Number: </strong></td>
				<td>{{ $asset->asset_number }}</td>
			</tr>
			<tr>
				<td><strong>Purchase Date: </strong></td>
				<td>{{ date('jS M, Y', strtotime($asset->purchase_date)) }}</td>
			</tr>
			<tr>
				<td><strong>Purchase Price: </strong></td>
				<td>{{ asMoney($asset->purchase_price) }}</td>
			</tr>
			<tr>
				<td><strong>Book Value: </strong></td>
				<td>{{ asMoney($asset->book_value) }}</td>
			</tr>
		</table>
	</div>

	<div class="col-lg-4">
		<table class="table table-stripped table-condensed">
			<tr>
				<td><strong>Serial Number: </strong></td>
				<td>{{ $asset->serial_number }}</td>
			</tr>
			<tr>
				<td><strong>Warranty Expiry: </strong></td>
				<td>{{ date('jS M, Y', strtotime($asset->warranty_expiry)) }}</td>
			</tr>
			<tr>
				<td><strong>Asset Status: </strong></td>
				<td>{{ $asset->status }}</td>
			</tr>
			<tr>
				<td><strong>Salvage Value: </strong></td>
				<td>{{ asMoney($asset->salvage_value) }}</td>
			</tr>
			<tr>
				<td><strong>Depreciatin Start Date: </strong></td>
				<td>{{ date('jS M, Y', strtotime($asset->depreciation_start_date)) }}</td>
			</tr>
		</table>
	</div>

	<div class="col-lg-4">
		<table class="table table-stripped table-condensed">
			<tr>
				<td><strong>Last Depreciated: </strong></td>
				<td>{{ date('jS M, Y', strtotime($asset->last_depreciated)) }}</td>
			</tr>
			<tr>
				<td><strong>Depreciation Method: </strong></td>
				@if($asset->depreciation_method = 'SL')
				<td>Straight-Line</td>
				@elseif($asset->depreciation_method = 'SY')
				<td>Sum-of-Years</td>
				@elseif($asset->depreciation_method = 'DB')
				<td>Declining Balance(1.5)</td>
				@endif
			</tr>
			<tr>
				<td><strong>Averaging Method: </strong></td>
				@if($asset->averaging_method = 'FULLMO')
				<td>Full Month</td>
				@elseif($asset->averaging_method = 'HALFYR')
				<td>Half Year</td>
				@elseif($asset->averaging_method = 'MIDMO')
				<td>Mid Month</td>
				@elseif($asset->averaging_method = 'MIDQ')
				<td>Mid Quarter</td>
				@elseif($asset->averaging_method = 'HALFYR')
				<td>Half Year</td>
				@endif
			</tr>
			@if($asset->method == 'years')
			<tr>
				<td><strong>Life Years</strong></td>
				<td>{{ $asset->years }} years</td>
			</tr>
			@elseif($asset->method == 'rate')
			<tr>
				<td><strong>Annual Depreciation Rate: </strong></td>
				<td>{{ $asset->rate }}%</td>
			</tr>
			@endif
		</table>
	</div>
</div><hr>

<div class="row">
	<div class="col-lg-12 text-right">
		<a href="{{ URL::to('assetManagement/'.$asset->id.'/edit') }}" class="btn btn-warning btn-sm">Edit Details</a>&emsp;
		@if($asset->book_value == $asset->purchase_price)
		<a href="{{ URL::to('assetManagement/'.$asset->id.'/depreciate') }}" class="btn btn-success btn-sm">Run Depreciation</a>
		@else
		<a href="{{ URL::to('assetManagement/'.$asset->id.'/depreciate') }}" class="btn btn-success btn-sm">Re-run Depreciation</a>
		@endif
	</div>
</div><hr>

@stop