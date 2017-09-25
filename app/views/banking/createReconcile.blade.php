@extends('layouts.accounting')
@section('content')

<?php
	function asMoney($value) {
	  return number_format($value, 2);
	}
?>

<style type="text/css" media="screen">
		h4,h6{
			margin-bottom: 7px;
			margin-top: 7px;
		}	

		h6{ color: #777; }

		hr{
			margin: 15px 0;
		}

		.bal{
			width: auto;
			display: inline-block;
			margin: 10px 0; 
			padding: 0 10px;
			text-align: center;
		}

		.tab-pane{
			padding-top: 15px;
		}

		table.recon > thead tr th{
			border-bottom: 1px solid #ddd !important; 
			text-align: center;
		}
		
		table.recon tbody tr td{
			vertical-align: middle !important;
		}

		table.recon tbody tr td{
			border-bottom: 1px solid #ddd !important;
		}

		table.bord{
			width: 100%;
			table-layout: fixed;
			margin: 7px 0;
		}
		
		table.bord .bnk_stmt{ background: #ECEFF1 }
		table.bord .gl_stmt{ background: #FBFBFB }

		table.bord tr td{	border: 1px solid #ddd !important;}
		
		td.cnter, th.cnter, tr.gl_stmt td{
			text-align: center;
			vertical-align: middle !important;
		}
		
		table.hdr{
			margin-top: 10px;
			background: #E1F5FE !important;
			font-weight: 500;
			border-bottom: none;
		}

		tr.hder{
			background: #E1F5FE;
		}

</style>

<!--
BEGINNING OF PAGE
-->
<div class="row">
	<div class="col-lg-12">
		<h4><font color='green'>Bank Reconciliation</font></h4>
		<hr>
	</div>
	<div class="col-lg-12">
		@if(isset($bnkAccount))

			<div class="col-lg-12" style="margin-top: 0; background: #E1F5FE !important;">
				<div class="bal">
					<h4><font color="#0BAEED">{{ $bnkAccount->account_name }}</font></h4>
					<h6>{{ $bnkAccount->account_number }}</h6>
				</div>
				<div class="bal" style="border-left: 1px solid #ddd !important;">
					<h4><font color="#0BAEED">{{ $bnkAccount->bank_name }}</font></h4>
					<h6>Bank Name</h6>
				</div>
				<div class="bal" style="border-left: 1px solid #ddd !important;">
					<h4><font color="#0BAEED">Reconciliation</font></h4>
					<h6>for: <strong>{{ $rec_month }}</strong></h6>
				</div>
				<div class="bal" style="border-left: 1px solid #ddd !important;">
					<h4><font color="#0BAEED">Last Reconciled Month: </font></h4>
					@if(isset($lastRec))
						<h6><font color="green"><strong>{{ $lastRec->stmt_month }}</strong></font></h6>
					@else
						<h6><font color="red"><strong> NULL </strong></font></h6>
					@endif
				</div>
			</div>
			<div class="col-lg-12" style="background: #fbfbfb; border-bottom: 1px solid #ddd;">
				<div class="bal">
					<h4><font color="#0BAEED">Ksh. {{ asMoney($bnkAccount->bal_bd) }}</font></h4>
					<h6>Bank Statement Balance</h6>
				</div>
				<div class="bal" style="border-left: 1px solid #ddd !important;">
					<h4><font color="red">Ksh. {{ asMoney($bkTotal) }}</font></h4>
					<h6>Xara Statement Balance(Adjusted)</h6>
				</div>
				<div class="bal" style="border-left: 1px solid #ddd !important;">
					<h4><font color="#44B78B">{{ $count }} Items Reconciled</font></h4>
					<h6>Total Items Reconciled </h6>
				</div>
			</div>

		@endif
	</div>
		
	<!--
		TAB-LINKS
	-->
	<div class="col-lg-12" style="background: ">
		<br><br>
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#reconcile">Reconcile</a></li>
			<li><a data-toggle="tab" href="#bnkStmt">Bank Statements</a></li>
			<li><a data-toggle="tab" href="#acTransact">Statements Transactions</a></li>
		</ul>

	
		<div class="tab-content">
			<!--
				RECONCILIATION TAB
			-->
			<div id="reconcile" class="tab-pane fade in active">
				<table class="table table-bordered recon">
					<thead>
						<tr>
							<th></th>
							<th><font color="#44B78B">Review Your Bank Statements&hellip;</font></th>
							<th class="cnter"></th>
							<th><font color="#44B78B">&hellip;And match them against your Book Balance</font></th>
						</tr>
					</thead>
					<tbody>
						<!-- Transactions -->
						<?php $count=1; ?> 
							<col width="3%" />
							<col width="42%" />
							<col width="10%" />
							<col width="45%" />
						<tr class="hder">
							<td></td>
							<td>
								<table class="table hdr"> 
									 <col width="22%" />
								    <col width="38%" />
								    <col width="20%" />
								    <col width="20%" />
									<tr>
										<td>Date</td>
										<td>Transactionn</td>
										<td>Debit</td>
										<td>Credit</td>
									</tr>
								</table>
							</td>
							<td class="cnter"><!-- <a href="" class="btn btn-success btn-sm">Approve All</a> --></td>
							<td>
								<table class="table hdr"> 
									<tr></tr>
								</table>
							</td>
						</tr>
						<!-- /.end of transactions header -->

						@if(count($stmt_transactions) > 0)
						@foreach($stmt_transactions as $strans)
							
							<!-- Transactions -->
							<!-- ITEM RECONCILIATION FORM STARTS HERE -->
							<tr>
							<form role="form" class="form-inline" action="{{ URL::to('bankAccount/reconcile') }}" method="POST">
								<td>{{ $count }}</td>
								<td>
									<table class="table bord"> 
										 <col width="22%" />
									    <col width="38%" />
									    <col width="20%" />
									    <col width="20%" />
										<tr class="bnk_stmt">
											<td>{{ $strans->transaction_date }}</td>
											<td >{{ $strans->description }}</td>
											@if($strans->transaction_amnt < 0)
												<td>{{ asMoney(ltrim($strans->transaction_amnt, '-')) }}</td>
												<td></td>
											@else
												<td></td>
												<td>{{ asMoney($strans->transaction_amnt) }}</td>
											@endif
										</tr>
									</table>
								</td>
								<td class="cnter">
									<!-- <a href="" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-ok"></i></a>&emsp;
									<a href="" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-remove"></i></a> -->
									<strong><font color="green">Reconcile With&hellip;</font></strong>
								</td>
								<td>
									<table class="table bord">
										 <col width="72%" />
									    <col width="28%" /> 
 										<tr class="gl_stmt">
											<input type="hidden" name="bnk_stmt_id" value="{{ $bnk_stmt_id }}">
											<input type="hidden" name="bnk_trans_id" value="{{ $strans->id }}">
											<input type="hidden" name="ac_stmt_id" value="{{ $ac_stmt_id }}">
											<input type="hidden" name="bk_total" value="{{ $bkTotal }}">
											<td>
												<select class="form-control" name="ac_transaction" required>
													<option>Match an existing transaction OR add if it doesn't exist.</option>
													<option>============================</option>
													@foreach($ac_transaction as $atrans)
														<option value="{{ $atrans->id }}">
															{{ $atrans->transaction_date }} | {{ $atrans->description }} - {{ '('.asMoney($atrans->transaction_amount).')' }} | 
															@if($atrans->account_debited == $ac_stmt_id) 
																{{ "(Debit)" }}
															@else
																{{ "(Credit)" }}
															@endif
														</option>
													@endforeach
												</select>
											</td>
											<td>
												<input type="submit" class="btn btn-success btn-circle" name="btnReconcile" value="Ok">&nbsp;|
												<input type="submit" class="btn btn-warning btn-circle" name="btnEdit" value="Edit">&nbsp;
												<a href="{{ URL::to('bankAccount/reconcile/add/'.$strans->id.'/'.$bnk_stmt_id.'/'.$ac_stmt_id) }}" class="btn btn-primary btn-circle">Add</a>
											</td>
 										</tr> 
									</table>
								</td>
							</form> <!-- /.end of item recinciliation form -->
							</tr><!-- /.end of transactions -->
							<?php $count++ ?>
							
						@endforeach

						@elseif($bnkAccount->bal_bd === $bkTotal)
							<tr>
								<td colspan="4" class="cnter">
									<h3><font color="green">Accounts Successfully Reconciled</font></h3>
									<p><font>No Pending Reconciliations</font></p>
								</td>
							</tr>

						@elseif(count($stmt_transactions) > 0 && count($ac_transaction) <= 0)
							<tr>
								<td colspan="4" class="cnter">
									<h3><font color="red">No Transaction Items for Reconciliation on This Account </font></h3>
									<p><font>Please try reconciling with the asset account associated with this bank account</font></p>
								</td>
							</tr>

						@elseif(count($stmt_transactions) <= 0)
							<tr>
								<td colspan="4" class="cnter">
									<h3><font color="red">No Transactions Available at the Moment </font></h3>
									<p><font>Please upload a bank statement</font></p>
								</td>
							</tr>
						@endif

					</tbody>
				</table>
			</div> <!-- ./END OF RECONCILIATION TAB -->

			<!--
				BANK STATEMENTS TAB (ALL TIME BANK TRANSACTIONS)
			-->
			<div id="bnkStmt" class="tab-pane fade">
				<table class="table table-condensed table-bordered table-responsive table-hover users">
					<thead>
						<th>#</th>
						<th>Date Uploaded</th>
						<th>Statement Month</th>
						<!-- <th># Transactions</th> -->
						<th>Balance B/D</th>
						<th>Statement Status</th>
					</thead>

					<tbody>
						<?php $count=1; ?>
						@foreach($bAcc as $bAcc)
						<tr>
							<td>{{ $count }}</td>
							<td>{{ date('F d, Y', strtotime($bAcc->created_at)) }}</td>
							<td>{{ $bAcc->stmt_month }}</td>
							<!-- <td></td> -->
							<td>{{ asMoney($bAcc->bal_bd) }}</td>
							@if($bAcc->is_reconciled == 1)
							<td><font color="green">RECONCILED</font></td>
							@else
							<td><font color="red">NOT RECONCILED</font></td>
							@endif
						</tr>
						<?php $count++ ?>
						@endforeach
					</tbody>
				</table>
			</div> <!-- ./END OF BANK STATEMENTS TAB -->

			<!--
	 			ACCOUNT TRANSACTIONS (ALL TIME TRANSACTIONS)
			-->
			<div id="acTransact" class="tab-pane fade">
				<table class="table table-condensed table-bordered table-responsive table-hover users">
					<thead>
						<th>#</th>
						<th>Transaction Date</th>
						<th>Description</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Status</th>
					</thead>

					<tbody>
						<?php $i=1 ?>
						@foreach($bAccStmt as $bacStmt)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $bacStmt->transaction_date }}</td>
							<td>{{ $bacStmt->description }}</td>
							@if($bacStmt->transaction_amnt < 0)
								<td><font color="red">{{ asMoney(ltrim($bacStmt->transaction_amnt, '-')) }}</font></td>
								<td><font color="red">Debit</font></td>
							@else
								<td><font color="green">{{ asMoney($bacStmt->transaction_amnt) }}</font></td>
								<td><font color="green">Credit</font></td>
							@endif
							<td>{{ $bacStmt->status }}</td>
						</tr>
						<?php $i++ ?>
						@endforeach
					</tbody>
				</table>
			</div> <!-- ./END OF ACCOUNTS TRANSACTIONS TAB -->
		</div>
		
	</div>

</div>

@stop