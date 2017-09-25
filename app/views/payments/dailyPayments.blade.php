<?php
	function asMoney($value) {
	  return number_format($value, 2);
	}
?>

@extends('layouts.erp')
@section('content')

<div class="row">
	<div class="col-lg-12">
	  	<h4>Payments</h4>
		<hr>
	</div>	
</div>

<div class="row">
	<div class="col-lg-12">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5>
					{{ date('M j, Y') }} Payments&emsp;
					<a class="btn btn-primary btn-sm" href="{{ URL::to('daily_payments/pdf') }}"><i class="fa fa-file fa-fw"></i>Generate PDF</a>
				</h5>
			</div>

			<div class="panel-body">
				<table class="table users table-condensed table-bordered table-responsive table-hover">
					<thead>
						<th>#</th>
						<th>Customer</th>
						<th>Cash</th>
						<th>Mpesa</th>
						<th>Cheque</th>
					</thead>

					<tbody>
						@if(count($payments) > 0)
						<?php $count = 1; ?>
						@foreach($payments as $payment)
						<tr>
							  <td>{{ $count }}</td>
	                    <td>{{ $payment->client_name }}</td>
	                    @if($payment->payment_method == 'Cash')
	                    <td>{{ asMoney($payment->amount_paid) }}</td>
	                    <td></td>
	                    <td></td>
	                    @elseif($payment->payment_method == 'Mpesa')
	                    <td></td>
	                    <td>{{ asMoney($payment->amount_paid) }}</td>
	                    <td></td>
	                    @elseif($payment->payment_method == 'Cheque')
	                    <td></td>
	                    <td></td>
	                    <td>{{ asMoney($payment->amount_paid) }}</td>
	                    @endif
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

@stop