<html >

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">
*{
  font-size: 12px !important;
}

table {
  max-width: 100%;
  background-color: transparent;
}

table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

table.data{
  border-collapse: collapse;
  border: 1px solid #BBB;
}

table.data th, table.data td{
  padding: 5px 10px;
  border: 1px solid #BBB;
}

th,td{
  padding: 2px 7px !important;
}

th {
  text-align: left;
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



img#watermark{
  position: fixed;
  width: 100%;
  z-index: 10;
  opacity: 0.1;
}

</style>

<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>
</head>

<body>
<!--     <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark"> -->

  <div class="header">
       <table border='0'>

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


  <div class="content" style='margin-top:70px;'>
   <!-- <div align="center"><strong>Sales Report as at {{date('d-M-Y')}}</strong></div><br> -->
   <div align="center"><strong>Sales Report as from:  {{$from}} To:  {{$to}}</strong></div><br>

    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>
        


        <th width='20'><strong># </strong></th>
        <th><strong>Order Number </strong></th>
        <th><strong>Customer Name </strong></th>
        <th><strong>Item Name </strong></th>
        <th align="center"><strong>Quantity </strong></th>
        <th align="right"><strong>Price </strong></th>
        <th align="right"><strong>Total Amount </strong></th>
        <th>Barcode Inline</th>
        
      </tr>

     
      <?php $i =1; $total = 0; ?>
      @foreach($sales as $sales)
      
      <?php
      $total = $total + ($sales->price * $sales->quantity)

      ?>

      <tr>


       <td td width='20'>{{$i}}</td>
        <td> {{ $sales->order_number }}</td>
        <td> {{ $sales->client }}</td>
        <td> {{ $sales->item }}</td>
        <td align = "center"> {{ $sales->quantity }}</td>
        <td align = "right"> {{asMoney($sales->price)}}</td>
        <td align = "right"> {{ asMoney($sales->price * $sales->quantity)}}</td>
                     
        
        </tr>
      <?php $i++; ?>
   
    @endforeach



    <tr>
           <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Grand Total</strong></td>
            <td align = "right"><strong>{{asMoney($total)}}</strong></td>


            

            
            
          
        </tr>

       

    </table>

<br><br>

   
</div>


</body>

</html>



