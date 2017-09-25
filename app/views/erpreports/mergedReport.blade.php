<?php
	function asMoney($value) {
	  return number_format($value, 2);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<style type="text/css" media="screen">
			*{
				font-family: Helvetica !important; 
				font-size: 10px !important;
				color: #555;
			}

			h3{
				font-size: 13px !important;
				color: green;
				//text-decoration: underline;
				//margin-bottom: 5px;
			}
			
			table, tr, td, th, tbody, thead, tfoot {
    			page-break-inside: avoid !important;
			}

			th,td{
			  padding: 2px 7px !important;
			}

			.one{
				margin: 10px 5px !important;
				padding: 5px 10px;
				width: auto;
				max-width: 30%;
				display: inline-block;
				//border: 1px solid #ccc;
			}

			.two{
				margin: 20px 5px !important;
				padding: 5px 10px;
				width: auto;
				//border: 1px solid #ccc;
			}

			tr.ageing td, tr.subtt td{
				font-weight: bold !important;
			}

			tr td.amnt{
				text-align: right !important;
			}

			th.left{
				text-align: left !important;
			}

		</style>
	</head>

	<body>
		<div class="row">
			<div class="col-lg-12">
				<div class="header">
					<table >
						<tr>
							<td style="width:150px">
								<img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="50%">
							</td>
							<td>
								<strong>
								{{ strtoupper($organization->name)}}
								</strong><br><p>
								{{ $organization->phone}}<br><p> 
								{{ $organization->email}}<br><p> 
								{{ $organization->website}}<br><p>
								{{ $organization->address}}
							</td>
							<td style="vertical-align: middle;">
								<h1 style="margin-left: 30px">GENERAL REPORT</h1>
								<h1 style="margin-left: 30px">{{ date('jS M, Y') }}</h1>
							</td>
						</tr>
					</table>
				</div>
				<hr>
			</div>
		</div>



		<div class="row">

			<!-- ACCOUNT BALANCES, DAILY COLLECTIONS, OFFICE EXPENSES -->
			<div class="col-lg-12">
				<div class="one">
					<h3>ACCOUNT BALANCES</h3>
					<table style="width: 100%;">
						<thead>
							<tr>
								<th class="left">ACCOUNT</th>
								<th class="amnt">BALANCE</th>
							</tr>
						</thead>
						<tbody>
							@foreach($accounts as $account)
							<tr>
								<td>{{ $account->name }}</td>
								<td class="amnt">{{ asMoney($account->balance) }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="one">
					<h3>DAILY COLLECTIONS</h3>
					<table style="width: 100%;">
						<thead>
							<tr>
								<th class="left">NAME</th>
								<th class="amnt">AMOUNT RECEIVED</th>
								<th class="amnt">PAYMENT METHOD</th>
							</tr>
						</thead>
						<tbody>
							@if(count($dailyCollections) > 0)
							@foreach($dailyCollections as $dailyCollection)
							<tr>
								<td>{{ $dailyCollection->client_name }}</td>
								<td class="amnt">{{ asMoney($dailyCollection->amount_paid) }}</td>
								<td class="amnt">{{ $dailyCollection->payment_method }}</td>
							</tr>
							@endforeach
							@else
								<tr>
									<td colspan="3"><h2><font color="red">No Collections Today</font></h2></td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>

				<div class="one">
					<h3>OFFICE EXPENSES</h3>
					<table style="width: 100%;">
						<thead>
							<tr>
								<th class="left">ITEM</th>
								<th class="amnt">AMOUNT</th>
							</tr>
						</thead>
						<tbody>
							@if(count($expenses) > 0)
							@foreach($expenses as $expense)
							<tr>
								<td> {{ $expense->name }} </td>
								<td class="amnt">{{ asMoney($expense->amount) }}</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div><!-- ./END -->
			<hr>
			
			<!-- DAILY SALES BY CUSTOMER SUMMARY -->
			<div class="col-lg-12">
				<div class="two"> 
					<h3>DAILY SALES REPORT</h3>
					<table>
	               <thead>
							<tr class="top">
								<th class="left">DOMESTIC/HOUSEHOLD CLIENTS</th>
								<th class="amnt">QTY</th>
								<th>DESCRIPTION</th>
								<th>SALES AMOUNT</th>
							</tr>
						</thead>
						
						<?php $dSubTotal=0; $iSubTotal=0; ?>
						<tbody>
							@if(count($sales) > 0)
							@foreach($sales as $dom)
							@if($dom->category == 'Domestic')
								<?php
									$dSubTotal = $dSubTotal + ($dom->price * $dom->quantity)-($dom->percentage_discount);
								?>

								<tr class="body">
									<td class="left">{{ $dom->client }}</td>
									<td class="amnt">{{ $dom->quantity }}</td>
							      <td class="amnt">{{ $dom->description }}</td>
							      <td class="amnt">{{ asMoney(($dom->price * $dom->quantity)-($dom->percentage_discount)) }}</td>
								</tr>

							@endif
							@endforeach
							    <tr class="totals subtt">
							      <td>SUBTOTALS</td>
							      <td></td>
							      <td></td>
							      <td class="amnt">{{ asMoney($dSubTotal) }}</td>
							    </tr>
							@endif
						</tbody>
						
						<thead>
							<tr class="top">
								<th class="left">INSTITUTIONAL CLIENTS/ HOTELS & RESTAURANTS</th>
								<th class="amnt">QTY</th>
								<th>DESCRIPTION</th>
								<th>SALES AMOUNT</th>
							</tr>
						</thead>
						
						<tbody>
							@if(count($sales))
							@foreach($sales as $inst)    
							@if($inst->category == 'Institutional')
								<?php
									$iSubTotal = $iSubTotal + ($inst->price * $inst->quantity)-($inst->percentage_discount);
								?>
							  
							    <tr class="body">
							      <td class="left">{{ $inst->client }}</td>
							      <td class="amnt">{{ $inst->quantity }}</td>
							      <td class="amnt">{{ $inst->description }}</td>
							      <td class="amnt">{{ asMoney(($inst->price * $inst->quantity)-($inst->percentage_discount)) }}</td>
							    </tr>

							@endif
							@endforeach
							    <tr class="totals subtt">
							      <td>SUBTOTALS</td>
							      <td></td>
							      <td></td>
							      <td class="amnt">{{ asMoney($iSubTotal) }}</td>
							    </tr>

							<tr class="totals subtt">
							  <td>TOTALS</td>
							  <td colspan='2'></td>
							  <td class="amnt">{{ asMoney($iSubTotal+$dSubTotal) }}</td>
							</tr>
							@endif
						</tbody>
					</table>
					<h4><strong>Cumulative Monthly Sales: </strong></h4>
					<strong> KES. {{ asMoney($totalSales) }} </strong>
				</div>
			</div><!-- ./END -->
			<hr>
			
			<!-- SALES TO DATE AS PERCENTAGE OF TARGET -->
			<div class="col-lg-12" style="vertical-align: top;">
				<div class="two">
					<h3>SALES  TO DATE HAS A PERCENTAGE  OF THE 10 MILLION SALES TARGET</h3>
					<div class="one">
						sales todate <hr style="margin: 1px 0 !important"> 
						sales target
					</div>
					<div class="one">
						=
					</div>
					<div class="one">
						{{ asMoney($totalSales) }} <hr style="margin: 1px 0 !important"> 
						{{ asMoney($monthlyTarget) }}
					</div>
					<div class="one" style="margin-bottom: 10px !important">
						=	
					</div>
					<div class="one">
						{{ ($totalSales/$monthlyTarget)*100 }}%  November Sales
					</div>
				</div>
			</div><!-- ./END -->
			<hr>
			
			<!-- SALES TO DATE HAS COMPARED  TO   PREVIOUS MONTH'S SALES OVER  A SIMILAR PERIOD -->
			<div class="col-lg-12">
				<div class="two">
					<h3>SALES TO DATE HAS COMPARED TO PREVIOUS MONTH'S SALES OVER A SIMILAR PERIOD</h3>
					<table style="width: 100%;">
						<thead>
							<tr>
								<th class="left">{{ date('F') }} SALES AS {{ date('dS') }}</th>
								<th class="left">{{ date('F', strtotime('-1 month')) }} SALES AS {{ date('dS') }}</th>
								<th class="left">Incremental Sales</th>
								<th class="left">%age Change</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ asMoney($totalSales) }}</td>
								<td>{{ asMoney($lastMonthSales) }}</td>
								<td>
									{{ asMoney($totalSales-$lastMonthSales) }}
								</td>
								<td>
									@if($lastMonthSales <= 0) 
									100%
									@else
									{{ ($totalSales/$lastMonthSales)*100 }}%
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div><!-- ./END -->
			<hr>

			<!-- DEBTOR'S AGEING REPORT -->
			<div class="col-lg-12">
				<div class="two">
					<h3>DEBTOR'S AGEING REPORT</h3>
					<table style="width: 100%;">
		            <tr class="top ageing">
	    					<td class="left">#</td>
	    					<td class="left">Name</td>
	    					<!-- <th>Discount (%)</th> -->
							<td class="amnt">Current</td>
							<td class="amnt">1-30</td>
							<td class="amnt">31-60</td>
							<td class="amnt">61-90</td>
							<td class="amnt">> 90</td>
	    					<td class="amnt">TOTAL</td>
		            </tr>

		    			<tbody>
		    				<?php 
		               	$count = 1; 
		                	$dueTodayTotal = 0;
		                	$due30Total = 0;
		                	$due60Total = 0;
		                	$due90Total = 0;
		                	$due91Total = 0;
		                	$dueTotal = 0;
		               ?>
	  						@foreach($clients as $client)
	  						@if(Client::due($client->id) > 0)
		  						<tr class="body">
		  							<td class="left">{{ $count }}</td>
		  							<td class="left">{{ $client->name }}</td>
		  							<!-- <td align="center">{{ asMoney($client->percentage_discount) }}</td> -->
									<td class="amnt"> {{ asMoney(Client::dueToday($client->id)) }} </td>
									<td class="amnt"> {{ asMoney(Client::due30($client->id)) }} </td>
									<td class="amnt"> {{ asMoney(Client::due60($client->id)) }} </td>
									<td class="amnt"> {{ asMoney(Client::due90($client->id)) }} </td>
									<td class="amnt"> {{ asMoney(Client::due91($client->id)) }} </td>
		  							<td class="amnt"> {{ asMoney(Client::due($client->id)) }} </td>
		  						</tr>
		  					<?php 
								$count++;
								$dueTodayTotal += Client::dueToday($client->id);
								$due30Total += Client::due30($client->id);
								$due60Total += Client::due60($client->id);
								$due90Total += Client::due90($client->id);
								$due91Total += Client::due91($client->id); 
								$dueTotal += Client::due($client->id);
							?>
							@endif	
							@endforeach
								<tr class="totals ageing">
									<td colspan="2" class="amnt">TOTALS</td>
									<!-- <td align="center">{{ asMoney($client->percentage_discount) }}</td> -->
									<td class="amnt"> {{ asMoney($dueTodayTotal) }} </td>
									<td class="amnt"> {{ asMoney($due30Total) }} </td>
									<td class="amnt"> {{ asMoney($due60Total) }} </td>
									<td class="amnt"> {{ asMoney($due90Total) }} </td>
									<td class="amnt"> {{ asMoney($due91Total) }} </td>
									<td class="amnt"> {{ asMoney($dueTotal) }} </td>
								</tr>
		    				</tbody>
	    			</table>
				</div>
			</div><!-- ./END -->
			<hr>

		</div>
	</body>
</html>