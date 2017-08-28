<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

<html >

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">
/* body{
  font-family: "Roboto";
  //font-size: 95% !important;
  //letter-spacing: 1px !important;
} */

table {
  max-width: 100%;
  background-color: transparent;
}

table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th,td{
  padding: 2px 7px !important;
}


table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th {
  text-align: left;
}

th,td{
  padding: 2px 7px !important;
}

.table {
  width: 100%;
   margin-bottom: 150px;
}
hr {
  margin-top: 1px;
  margin-bottom: 2px;
  border: 0;
  border-top: 2px dotted #eee;
}

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 12px;
  line-height: 1.428571429;
  color: #333;
  background-color: #fff;


 @page { margin: 50px 30px; }
 .header { position: top; left: 0px; top: -150px; right: 0px; height: 100px;  text-align: center; }
 .content {margin-top: -100px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }


</style>


</head>

<body>
    <!-- <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark"> -->
  <div class="header">
       <table >

      <tr>


       
        <td style="width:150px">

            <img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="50%">
    
        </td>

        <td>
        <strong>
          {{ strtoupper($organization->name)}}
          </strong><br>
          {{ $organization->phone}}<br>
          {{ $organization->email}}<br>
          {{ $organization->website}}<br>
          {{ $organization->address}}
       

        </td>
        

      </tr>


      <tr>

        <hr>
      </tr>



    </table>
   </div>



<div class="footer">
     <p class="page">Page <?php $PAGE_NUM ?></p>
   </div>


	<div class="content" style='margin-top:0px;'>
   <!-- <div align="center"><strong>Payment Report as at {{date('d-M-Y')}}</strong></div><br> -->
   <div align="center"><strong>Payments Report as at {{date('d-M-Y')}} </strong></div><br>

    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>
        


        <th width='20'><strong># </strong></th>
        <th align="center"><strong>Date </strong></th>
        <th align="center"><strong>Client</strong></th>
        <th align="center"><strong>Type </strong></th>
        <th align="right"><strong>Amount</strong></th>        
        <th align="center"><strong>User </strong></th>
        
      </tr>
     

       <?php $i = 1; ?>
        @foreach($payments as $payment)

        <tr>

          <td> {{ $i }}</td>
          
          <td align="center">{{ date("d-M-Y",strtotime($payment->payment_date)) }}</td> 
          <td>{{ $payment->client->name }}</td>  
          <td align="right">{{ $payment->client->type }}</td>
          <td align="right">{{ asMoney($payment->amount_paid) }}</td>
          <td align="center"> {{ $payment->received_by }}</td>
               

        </tr>
      <?php $i++; ?>
   
    @endforeach

     

    </table>

<br><br>

   
</div>


</body>

</html>



