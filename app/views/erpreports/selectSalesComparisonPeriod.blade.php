@extends('layouts.erp_ports')
@section('content')

<div class="row">
	<div class="col-lg-12">
    <h4>Select Months To Compare</h4>
<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

		@if (Session::has('error'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error! </strong>{{ Session::get('error') }}
            {{ Session::forget('error') }}
        </div>
        @endif

		<form method="POST" action="{{ URL::to('erpReports/getComparisonReport') }}" accept-charset="UTF-8">
            <fieldset>
                <div class="form-group">
                    <label>Select Month:<span style="color:red">*</span></label>
                    <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker2 input-sm" readonly="readonly" type="text" name="month" value="{{{ Input::old('from') }}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Compare With: <span style="color:red">*</span></label>
                    <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker2 input-sm" readonly="readonly" type="text" name="compareTo" value="{{{ Input::old('to') }}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Comparison Days: (max 31) <span style="color:red">*</span></label>
                    <input type="text" class="form-control input-sm" name="days" placeholder="Number of days (e.g. 25)" required>
                </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-primary btn-sm" >Select</button>
                </div>
          </fieldset>
      </form>
		
  </div>
</div>


@stop