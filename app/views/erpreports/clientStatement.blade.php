<?php
	function asMoney($value) {
	  return number_format($value, 2);
	}

  function sortArray($a, $b){
      $check = strnatcmp($a['date'], $b['date']);
      if(!$check)
      	$check = strnatcmp($a['transaction'], $b['transaction']);
      return $check;
  }

  function sortType($a, $b){
  		return strnatcmp($a['transaction'], $b['transaction']);
  }

  //$stmt = usort($stmt, 'sortArray');
?>

<html>
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		
		<style type="text/css">
			
			table.main {
				width: 100%;
			  max-width: 100%;
			  border-collapse: collapse;
				border: 1px solid #C5C5C5;
			  background-color: transparent;
			}

table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th,td{
  padding: 2px 7px !important;
}

			
			table.bordered{
				border-collapse: collapse;
				border: 1px solid #C5C5C5;
			}
			
			td, th{
				border-left: 1px solid #C5C5C5;
				border-bottom: 1px dashed #C5C5C5;
				padding: 5px 10px;
			}

			tr td.data, tr th.data{
				text-align: center;
				border: 1px solid #C5C5C5;
			}

			th {
			  text-align: left;
			}
			.table {
			  width: 100%;
			   margin-bottom: 50px;
			}
			hr{
				color: #c5c5c5;
			  //border-top: 1px solid #d5d5d5;
			}

			body {
			  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			  font-size: 12px;
			  line-height: 1.428571429;
			  color: #333;
			  background-color: #fff;
			}

			 @page { margin: 50px 30px; }
			 .header { position: top; left: 0px; top: -150px; right: 0px; height: 100px;  text-align: center; }
			 .content {margin-top: -100px; margin-bottom: -150px}
			 .footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px;  }
			 .footer .page:after { content: counter(page, upper-roman); }
			
			img.watermark{
			  position: fixed;
			  width: 100%;
			  z-index: 10;
			  opacity: 0.1;
			}


		</style>
	
	</head>


	<body>
	<!-- <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark"> -->

		<div class="header"> 
			
			<table class="main">
				<tr>
					
					<td style="width: 150px; border:none">
						<img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="50%">
					</td>

					<td style="border:none">
						<strong>{{ strtoupper($organization->name)}}</strong><br>
	          {{ $organization->phone}}<br>
	          {{ $organization->email}}<br>
	          {{ $organization->website}}<br>
	          {{ $organization->address}} 	
					</td>

					<td style="width: 100px; border:none">
						<strong>STATEMENT</strong><br>
						<table class="">
							<tr>
								<td style="border:1px solid #c5c5c5;">
									Date<br><hr>
									{{$asAt}}
								</td>
							</tr>
						</table>
					</td>

				</tr>
				
			</table><br>

			<table class="bordered" style="width: 250px;">
				<tr>
					<td style="border:1px solid #c5c5c5; padding-left: 5px;">
						TO<br><hr>
						Name: {{$erporder->client->name}}<br>
            Phone: {{$erporder->client->phone}}<br>
            Address: {{$erporder->client->address}}<br> 
					</td>
				</tr>
			</table><br><br>
			
			<table class="main centered" style="border: 1px solid #C5C5C5;">
				<tr class="head">
					<th style="border:none"></th>
					<th style="border:none"></th>
					<th class="data">Amount Due</th>
					<th class="data">Amount Enc.</th>
				</tr>
				<tr class="head">
					<th style="border:none"></th>
					<th style="border:none"></th>
					<th class="data">KES {{Client::due($erporder->client->id)}}</th>
					<th class="data"></th>
				</tr>
				<tr>
					<th class="data">Date</th>
					<th class="data">Transaction</th>
					<th class="data">Amount</th>
					<th class="data">Balance</th>
				</tr>

				<?php $total=0; $item_total=$client->balance; $client_discount_amt=0; $total_discounted=0; ?>
				<tr>
						<td style="text-align: center; vertical-align: top;"><strong>{{$client->date}}</strong></td>
						<td><strong>Balance b/f</strong></td>
						<td style="text-align: right; vertical-align: bottom;"><strong></strong></td>
						<td style="text-align: right; vertical-align: bottom;"><strong>{{asMoney($client->balance)}}</strong></td>
				</tr>
				
				@if(count($stmt) > 0)
				<?php 
						usort($stmt, 'sortArray'); 
				?>
				@foreach($stmt as $stmt)
					@if($stmt['transaction'] === 'order')
						<?php
		            $client_discount_amt = $client_discount_amt + $stmt['discount_amount'];
		            $client_discount =  $stmt['client_discount']; 
		            $amount = $stmt['item_price'] * $stmt['item_qty'];
		            /*$total_amount = $amount * $orderitem['duration'];*/
		            $item_total = $item_total+($amount-$client_discount);
		            //$total = $total + ($orderitem->price * $orderitem->quantity)-$client_discount;
		            $total_discounted = $total_discounted + ($stmt['item_price'] * $stmt['item_qty'])-$client_discount-$stmt['discount_amount'];	
	          ?>

	          <tr>
								<td style="text-align: center; vertical-align: top;">{{$stmt['date']}}</td>
								<td>
										<font style="font-size: 11px;">
											INV #{{$stmt['order_number']}}. Due {{$stmt['date']}}<br>
											&emsp;&emsp;---{{$stmt['item']}}, {{$stmt['item_qty']}} @ KES {{$stmt['item_price']}} = {{$amount}}<br>
											&emsp;&emsp;---<strong>Discount = {{$client_discount}} || Total = {{$amount-$client_discount}}</strong>
										</font>
								</td>
								<td style="text-align: right; vertical-align: bottom;">{{asMoney($amount-$client_discount)}}</td>
								<td style="text-align: right; vertical-align: bottom;">{{asMoney($item_total)}}</td>
						</tr>

					@else
						<?php
								$item_total = $item_total-$stmt['amount_paid']; 
						?>

						<tr>
								<td style="text-align: center; vertical-align: top;">{{$stmt['date']}}</td>
								<td>
										<font style="font-size: 11px;">
											<strong>PYMNT #{{$stmt['payment_id']}}. Amount = {{$stmt['amount_paid']}}</strong>
										</font>
								</td>
								<td style="text-align: right; vertical-align: bottom;">{{asMoney(-$stmt['amount_paid'])}}</td>
								<td style="text-align: right; vertical-align: bottom;">{{asMoney($item_total)}}</td>
						</tr>
					@endif
				@endforeach
				@endif

						<tr>
								<td style="text-align: center; vertical-align: top;"></td>
								<td><strong>Accumulated Discount</strong></td>
								<td style="text-align: right; vertical-align: bottom;"><strong>{{asMoney(-$client_discount_amt)}}</strong></td>
								<td style="text-align: right; vertical-align: bottom;"><strong>{{asMoney($item_total-$client_discount_amt)}}</strong></td>
						</tr>


					<!--<td>Date</td>
					<td>Transaction hdvhbdf dhfvhfdv dhgvdfhgvhd hgvfdhgvhfdg hgvdfghvghdv vgdvfghvhgfd hgdf vghvvv dfhgv df </td>
					<td>Amount</td>
					<td>Balance</td>
				</tr>-->
			</table>

		</div>

	</body>
</html>