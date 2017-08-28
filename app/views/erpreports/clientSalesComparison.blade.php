<?php 
	function asMoney($value){
		return number_format($value, 2);
	}
?>

<html>
<head>
  <meta charset="utf-8">

  <style type="text/css" media="screen">
    @page { margin: 50px 30px; }
   .header { position: top; left: 0px; top: -150px; right: 0px; height: 100px;  text-align: center; }
   .content {margin-top: -100px; margin-bottom: -150px}
   .footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px;  }
   .footer .page:after { content: counter(page, upper-roman); }
   
    table{
      width: 100%;
      border: 1px solid #ddd;
      font-family: 'Roboto';
      font-size: 13px;
      border-collapse: collapse;
    }

table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th,td{
  padding: 2px 7px !important;
}


    table tr.top td{
      font-weight: bold;
    }

    td{
      padding: 2px 5px;
      border: 1px solid #ddd;
      text-align: right;
    }

    tr td.dum{
      font-weight: normal;
      text-align: left;
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
	<div class="col-lg-12" style="text-align: center">
		<h3>Gas Express</h3>
    <h4>Sales Comparison by Customer Summary</h4>
    <br>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
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
              <td>{{ $month }}</td>
              <td>{{ $compareTo }}</td>
              <td>Change</td>
              <td>%age Change</td>
            </tr>

    				<tbody>
    					<?php 
                $count = 1; 
                $monthlySalesTotal = 0;
                $compareToTotal = 0;
                $changeTotal = 0;
                //$percentageTotal = 0;
              ?>
              @if(count($summary) > 0)
  						@foreach($summary as $summary)
    						<tr class="body">
    							<td class="dum">{{ $count }}</td>
    							<td class="dum">{{ $summary['client_name'] }}</td>
                  <td> {{ asMoney($summary['monthlySales']) }} </td>
                  <td> {{ asMoney($summary['compareTo']) }} </td>
                  <td> {{ asMoney($summary['change']) }} </td>
                  <td> {{ asMoney($summary['percentage_change']) }}% </td>
    						</tr>
    						<?php 
                  $count++;
                  $monthlySalesTotal += $summary['monthlySales'];
                  $compareToTotal += $summary['compareTo'];
                  $changeTotal += $summary['change'];
                  //$percentageTotal += $summary['percentage_change'];
                ?>
  						@endforeach
              @endif
              <?php 
                if($monthlySalesTotal !== 0 || $compareToTotal !== 0){
                  $totalPercentAge = (($monthlySalesTotal-$compareToTotal)/$compareToTotal)*100;
                } else{
                  $totalPercentAge = NULL;
                }
                
              ?>
              <tr class="totals">
                <td colspan="2">TOTALS</td>
                <td> {{ asMoney($monthlySalesTotal) }} </td>
                <td> {{ asMoney($compareToTotal) }} </td>
                <td> {{ asMoney($changeTotal) }} </td>
                <td> {{ asMoney($totalPercentAge) }}% </td>
              </tr>
    				</tbody>
    			</table>
          <?php Session::forget('summary'); ?>

	</div>
</div>

</body>
<html>

