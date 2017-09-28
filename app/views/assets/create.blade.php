<?php
	function asMoney($value){
		return number_format($value, 2);
	}
?>

@extends('layouts.accounting')
@section('content')

<style type="text/css" media="screen">
	//hr{ border-color: #fff !important; }	
</style>

<div class="row">
	<div class="col-lg-12">
		<h4><font color="green">Add New Asset</font></h4>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form class="form-inline" role="form" action="{{ URL::to('assetManagement') }}" method="POST">
			<h4 style="color: #0BAEED">Asset Details</h4><hr>
			<div class="form-group">
				<label>Asset Name: </label><br>
				<input type="text" class="form-control input-sm" name="assetName" placeholder="Asset Name" style="width: 300px" required>
			</div>&emsp;

			<div class="form-group">
				<label>Asset Number: </label><br>
				<input type="text" class="form-control input-sm" name="assetNumber" value="{{ $assetNum }}" style="width: 250px" required>
			</div><br><br>

			<div class="form-group">
				<label>Purchase Date: </label>
				<div class="right-inner-addon ">
					<i class="fa fa-calendar"></i>
					<input type="text" class="form-control datepicker21 input-sm" readonly="readonly" name="purchaseDate" value="{{date('Y-m-d')}}" style="width: 200px">
				</div>
			</div>&emsp; 

			<div class="form-group">
				<label>Purchase Price: </label><br>
				<div class="input-group" style="width: 150px">
					<span class="input-group-addon">KES</span>
					<input type="text" class="form-control input-sm" name="purchasePrice" placeholder="{{ asMoney(0) }}" style="width: 200px" required>
				</div>
			</div>&emsp;

			<div class="form-group">
				<label>Warranty Expiry: </label><br>
				<div class="right-inner-addon ">
					<i class="fa fa-calendar"></i>
					<input type="text" class="form-control datepicker21 input-sm" readonly="readonly" name="warrantyExpiry" value="{{date('Y-m-d', strtotime('+1 year'))}}" style="width: 200px">
				</div>
			</div>&emsp;

			<div class="form-group">
				<label>Serial Number: </label><br>
				<input type="text" class="form-control input-sm" name="serialNumber" placeholder="Serial Number">
			</div><br><br>
			<hr><!-- ===================================== -->

			<h4 style="color: #0BAEED">Book Value</h4><hr>
			<div class="form-group">
				<label>Depreciation Start Date: </label><br>
				<div class="right-inner-addon ">
					<i class="fa fa-calendar"></i>
					<input type="text" class="form-control datepicker21 input-sm" readonly="readonly" name="depreciationStartDate" value="{{date('Y-m-d')}}" style="width: 200px" required>
				</div>
			</div><br><br>

			<div class="form-group">
				<label>Depreciation Method: </label><br>
				<select class="form-control input-sm" name="depreciationMethod" style="width: 300px" required>
					<option value="">-- No Depreciation --</option>
					<option value="SL">Straight-Line Method</option>
					<option value="SY">Sum of Years Digits</option>
					<option value="DB">Declining Balance(1.5)</option>
				</select>
			</div>&emsp;

			<div class="form-group">
				<label>First Year Averaging Method: </label><br>
				<select class="form-control input-sm" name="averagingMethod" style="width: 300px" required>
					<option value="FULLMO">Full Month</option>
					<option value="HALFYR">Half Year</option>
					<!-- <option value="MIDMO">Mid Month</option>
					<option value="MIDQ">Mid Quarter</option> -->
				</select>
			</div>&emsp;

			<div class="form-group">
				<label>Salvage Value: </label><br>
				<input type="text" name="salvageValue" class="form-control input-sm" placeholder="{{ asMoney(0) }}">
			</div><br><br>

			<div class="form-group">
				<label>Annual Rate(%): </label><br>
				<input type="radio" class="form-control input-sm" name="method" id="rateRadio" checked>
				<input type="text" class="form-control input-sm" name="rate" id="rate" placeholder="{{ asMoney(0) }}" style="width: 150px"> 
			</div>&emsp;

			<div class="form-group">
				<label>Useful Life (Years): </label><br>
				<input type="radio" class="form-control input-sm" name="method" id="rateYears">
				<input type="text" class="form-control input-sm" name="lifeYears" id="lifeYears" placeholder="" style="width: 150px" disabled>   
			</div><hr>
			
			<div class="col-lg-12 form-group text-right">
				<a href="{{ URL::to('assetManagement') }}" class="btn btn-danger btn-sm">Cancel</a>&emsp;
				<input type="submit" class="btn btn-primary btn-sm" name="btnSubmit" value="Register">
			</div><br><hr>

		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#rateRadio').on('click', function(){
			$('#rateRadio').prop('checked', true);
			$('#lifeYears').prop('checked', false);
			$('#rate').prop('disabled', false);
			$('#lifeYears').prop('disabled', true);
		});

		$('#rateYears').on('click', function(){
			$('#rateYears').prop('checked', true);
			$('#rateRadio').prop('checked', false);
			$('#lifeYears').prop('disabled', false);
			$('#rate').prop('disabled', true);
		});
	});
</script>

@stop