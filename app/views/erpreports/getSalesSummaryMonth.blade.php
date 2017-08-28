@extends('layouts.erp_ports')
@section('content')

<div class="row">
	<div class="col-lg-12">
    	<h4>Sales Summary Month</h4>
		<hr>
	</div>	
</div>

<div class="row">
	<div class="col-lg-5 col-md-6">
		<form action="{{ URL::to('erpReports/sales_summary') }}" method="POST" target="_blank">
			<div class="form-group">
				<label>Compare With <span style="color:red">*</span></label>
				<div class="right-inner-addon ">
					<i class="glyphicon glyphicon-calendar"></i>
					<input required class="form-control datepicker2 input-sm" readonly="readonly" type="text" name="summaryMonth" value="{{{ Input::old('to') }}}" required>
				</div>
			</div>
			<div class="form-actions form-group">
				<button type="submit" class="btn btn-primary btn-sm" >Generate</button>
			</div>
		</form>
	</div>
</div>

@stop