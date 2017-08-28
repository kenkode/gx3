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
    <h4>Sales By Customer Summary</h4>
    <h4>{{ $modMonth }}</h4>
    <br>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
          <div class="footer">
            <p class="page">Page <?php $PAGE_NUM; ?></p>
          </div>

            <table>
              <!-- <tbody> -->
                <tr class="top">
                  <td class="dum">DOMESTIC/HOUSEHOLD CLIENTS</td>
                  <td class="dum">QTY</td>
                  <td>DESCRIPTION</td>
                  <td>SALES AMOUNT</td>
                </tr>
                
                @if(count($dom) > 0)
                @foreach($dom as $dom)
                @if($dom['category'] == 'Domestic' && $dom['orderTotal'] > 0)

          						<tr class="body">
          							<td class="dum">{{ $dom['client_name'] }}</td>
          							<td class="dum">{{ $dom['qty'] }}</td>
                        <td>{{ $dom['desc'] }}</td>
                        <td>{{ asMoney($dom['orderTotal']) }}</td>
          						</tr>

                @endif
                @endforeach
                      <tr class="totals">
                        <td>SUBTOTALS</td>
                        <td></td>
                        <td></td>
                        <td>{{ asMoney($dSubTotal) }}</td>
                      </tr>
                @endif
                
                <tr class="top">
                  <td class="dum">INSTITUTIONAL CLIENTS/ HOTELS & RESTAURANTS</td>
                  <td class="dum">QTY</td>
                  <td>DESCRIPTION</td>
                  <td>SALES AMOUNT</td>
                </tr>
                
                @if(count($inst))
                @foreach($inst as $inst)    
                @if($inst['category'] == 'Institutional' && $inst['orderTotal'] > 0)
                    
                      <tr class="body">
                        <td class="dum">{{ $inst['client_name'] }}</td>
                        <td class="dum">{{ $inst['qty'] }}</td>
                        <td>{{ $inst['desc'] }}</td>
                        <td>{{ asMoney($inst['orderTotal']) }}</td>
                      </tr>

                @endif
                @endforeach
                      <tr class="totals">
                        <td>SUBTOTALS</td>
                        <td></td>
                        <td></td>
                        <td>{{ asMoney($iSubTotal) }}</td>
                      </tr>

                  <tr class="totals">
                    <td>TOTALS</td>
                    <td colspan='2'></td>
                    <td>{{ asMoney($iSubTotal+$dSubTotal) }}</td>
                  </tr>
                @endif
                <!-- </tbody> -->
              </table>
          <?php 
            Session::forget('monthlyDom');
            Session::forget('monthlyInst'); 
          ?>

	</div>
</div>

</body>
<html>

