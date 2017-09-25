<?php 
	function asMoney($value){
		return number_format($value, 2);
	}
?>

<html>
<head>
  <meta charset="utf-8">

  <style type="text/css" media="screen">
    @page { margin: 50px 30px; ;}
   .header { position: top; left: 0px; top: -150px; right: 0px; height: 100px;  text-align: center; }
   .content {margin-top: -100px; margin-bottom: -150px}
   .footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px;  }
   .footer .page:after { content: counter(page, upper-roman); }
   
    /* body{
      font-family: "Roboto";
      //font-size: 95% !important;
      //letter-spacing: 1px !important;
    } */

    table{
      width: 100%;
      border: 1px solid #ddd;
     /*  font-family: 'Roboto';
     font-size: 13px; */
      border-collapse: collapse;
    }

    p, h5{
      /* font-family: 'Roboto';
      font-size: 12px; */
      margin: 2px !important;
    }

    table tr.top td{
      font-weight: bold;
    }

    td{
      padding: 2px 5px;
      border: 1px solid #ddd;
      text-align: right;
    }

 

    table tr.body td{
      vertical-align: top;
    }

    h3, h4, h5{
      margin: 2px 0;
    }
    
    tr.totals td{
      font-weight: bold;
    }

  </style>

</head>

<body>

<div class="row">
	<div style="text-align: center">
		<h3>Gas Express</h3>
    <h4>A/R Aging Summary (Values in Home Currency)</h4>
    <h5>As of {{ date("F j, Y"); }}</h5>
    <hr>
	</div>
</div>

<div class="row">
      <h5>AMOUNT RECEIVED TODAY</h5>
      <p>
        AMOUNT RECEIVED: <strong>KES. {{ asMoney($total_payment->amount_paid) }}</strong> 
        = <strong>{{ round(($total_payment->amount_paid/$due)*100, 2) }}%</strong>
      </p>
      <p>AMOUNT RECEIVABLE: <strong>KES. {{ asMoney($due) }}</strong></p>
    </div><br>

      <h5>AMOUNT RECEIVED IN THE LAST MONTH</h5>
      <p>
        AMOUNT RECEIVED: <strong>KES. {{ asMoney($total_monthly->amount_paid) }}</strong> 
        = <strong>{{ round(($total_monthly->amount_paid/$due)*100, 2) }}%</strong>
      </p>
      <p>AMOUNT RECEIVABLE: <strong>KES. {{ asMoney($due) }}</strong></p>
    </div>
  </div>
  <hr>
</div>

<div class="row">
		  @if (Session::has('flash_message'))
      	<div class="alert alert-success">
      		{{ Session::get('flash_message') }}
     		</div>
    	@endif

    	@if (Session::has('delete_message'))
      		<div class="alert alert-danger">
      		{{ Session::get('delete_message') }}
     		</div>
    	@endif

    	
      <div class="footer">
        <p class="page">Page <?php $PAGE_NUM; ?></p>
      </div>

    			<table>
            <tr class="top">
    					<td class="dum">#</td>
    					<td class="dum">Name</td>
    					<!-- <th>Discount (%)</th> -->
              <td>Current</td>
              <td>1-30</td>
              <td>31-60</td>
              <td>61-90</td>
              <td>> 90</td>
    					<td>TOTAL</td>
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
  							<td class="dum">{{ $count }}</td>
  							<td class="dum">{{ $client->name }}</td>
  							<!-- <td align="center">{{ asMoney($client->percentage_discount) }}</td> -->
                <td> {{ asMoney(Client::dueToday($client->id)) }} </td>
                <td> {{ asMoney(Client::due30($client->id)) }} </td>
                <td> {{ asMoney(Client::due60($client->id)) }} </td>
                <td> {{ asMoney(Client::due90($client->id)) }} </td>
                <td> {{ asMoney(Client::due91($client->id)) }} </td>
  							<td> {{ asMoney(Client::due($client->id)) }} </td>
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
              <tr class="totals">
                <td>TOTALS</td>
                <!-- <td align="center">{{ asMoney($client->percentage_discount) }}</td> -->
                <td> {{ asMoney($dueTodayTotal) }} </td>
                <td> {{ asMoney($due30Total) }} </td>
                <td> {{ asMoney($due60Total) }} </td>
                <td> {{ asMoney($due90Total) }} </td>
                <td> {{ asMoney($due91Total) }} </td>
                <td> {{ asMoney($dueTotal) }} </td>
              </tr>
    				</tbody>
    			</table>

	</div>
</div>

</body>
<html>

