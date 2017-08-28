<html >

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">

body{
 /*  background-image: url('{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}');
 background-opacity: 0.1 !important; */
}

body:before{
  /* width: 50% !important; */
}

table {
  max-width: 100%;
  background-color: transparent;
  border-collapse: collapse !important;
}

table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th,td{
  padding: 2px 7px !important;
  vertical-align: top !important;
}

th {
  text-align: left;
  padding: 2px 7px !important;
  border: 1px solid #ccc !important;
}
.table {
  width: 100%;
  margin-bottom: 150px;
}
td{
  padding: 3px 7px !important;
  //border: 1px solid #ccc !important;
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


img.watermark{
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
     <p class="page">Page <?php $PAGE_NUM; ?></p>
   </div>


	<div class="content" style='margin-top:0px;'>

    <div align="center"><b>SUMMARY as at {{date('M-Y', strtotime($from))}}</b></div><br><br>
    <table  border='0'>


<tr>
  <td>{{date('M-Y', strtotime($from))}} Target:</td>
  @if(count($target) > 0){
      <td><b>{{asMoney($target->target_amount)}}</b></td>
  @else
      <td><b>NO TARGET SET</b></td>
  @endif
  
</tr>
<tr>
  <td>{{date('M-Y', strtotime($from))}} Sales:</td>
  <td><b>{{asMoney($sales_target->total_sales-$discount_amount_target->discount_amount)}}</b></td>
</tr>

<tr>
  <td>{{date('M-Y', strtotime($from))}} Sales as % of Target:</td>
  @if(count($target) > 0){
    <td><b>{{asMoney((($sales_target->total_sales-$discount_amount_target->discount_amount)/$target->target_amount)*100)}}%</b></td>
  @else
    <td><b>NO TARGET SET</b></td>
  @endif
</tr>

<tr>
  <td>Total Sales:</td>
  <td><b>{{asMoney($total_sales_todate->total_sales-$discount_amount_todate->discount_amount)}}</b></td>
</tr>
<!-- <tr><td>Total Cost Price:<td><b>{{asMoney(0)}}</b></td></td></tr> -->
<tr>
  <td>Total Amount Received:<td><b>{{asMoney($total_payment->amount_paid)}}</b></td></td>
</tr>
<hr>
<!-- <tr><td>Profit Margin:</td> <td><b>{{asMoney(0)}}</b></td></tr> -->
<tr>
  <td>Unpaid Amount :</td> 
  <td><b>{{asMoney(($total_sales_todate->total_sales-$discount_amount_todate->discount_amount)-($total_payment->amount_paid))}}</b></td>
</tr> 

<tr>
  <td>Unpaid Amount (%):</td> 
  <td><b>{{asMoney(((($total_sales_todate->total_sales-$discount_amount_todate->discount_amount)-($total_payment->amount_paid))/($total_sales_todate->total_sales-$discount_amount_todate->discount_amount))*100)}}%</b></td>
</tr> 

<tr><th colspan="2">Account Balances </th></tr>



      <tr>  
        
        <td> Account</td>
        
        <td align="right">Balance </td>
        
      </tr>
      
      @foreach($accounts as $account)
      <tr>

        <td> {{ $account->name }}</td>        
        <td align="right"> <b>{{ asMoney($account->balance) }}</b></td>
        
        </tr>
      
   
    @endforeach
</table>
<br>


   <!-- <div align="center"><strong>Sales Report as at {{date('M-Y', strtotime($from))}}</strong></div><br> -->
   <div align="center"><strong> {{date('M-Y', strtotime($from))}} Sales Report</strong></div><br>

    <table class="table table-bordered" border='0' cellspacing='0' cellpadding='0'>

      <tr>
        


        <th width='20'><strong># </strong></th>
        <th><strong>Order Number </strong></th>
        <th><strong>Customer Name </strong></th>        
        <th><strong>Item Name </strong></th>
        <th align="center"><strong>Quantity </strong></th>
        <th align="right"><strong>Price </strong></th>
        <th align="right"><strong>Total </strong></th>
        <th align="right"><strong>Client discount </strong></th>
        <th align="right"><strong>Payable Amount </strong></th>
        
      </tr>

     
       <?php $i =1; $total = 0; ?>
      @foreach($sales as $sales)

      <?php
      $total = $total + ($sales->price * $sales->quantity)-($sales->percentage_discount);     

      ?>

      <tr>


       <td td width='20'>{{$i}}</td>
        <td> {{ $sales->order_number }}</td>
        <td> {{ $sales->client }}</td>
        <td> {{ $sales->item }}</td>
        <td align = "center"> {{ $sales->quantity }}</td>
        <td align = "right"> {{asMoney($sales->price)}}</td>
        <td align = "right"> {{ asMoney($sales->price * $sales->quantity)}}</td>
        <td align = "right"> {{asMoney($sales->percentage_discount)}}</td>
        <td align = "right"> {{asMoney(($sales->price * $sales->quantity)-($sales->percentage_discount))}}</td>
                   
        
        </tr>

        <tr><td colspan="7"></tr>

      <?php $i++; ?>
   
    @endforeach



    <tr>
           <td colspan="6"></td>            
            <td colspan="2"><strong>Total Payable Amount</strong></td>
            <td align = "right"><strong>{{asMoney($total)}}</strong></td>           
          
        </tr>

        <tr>
           <td colspan="6"></td>
            <td colspan="2"><strong>Order Discount</strong></td>
            <td align = "right"><strong>{{asMoney($discount_amount->discount_amount)}}</strong></td>     
        
                   
        </tr>

        <tr>
             <td colspan="6"></td>
              <td colspan="2"><strong>Total Payable Amount</strong></td>
              <td align = "right"><strong>{{asMoney($total-$discount_amount->discount_amount)}}</strong></td>       
          
          </tr> 

    </table>

<br><br>
<hr>

<!-- <div align="center"><strong>Clients' Balances as at {{date('d-M-Y')}}</strong></div><br>   

    <table class="table table-bordered" border='0' cellspacing='0' cellpadding='0'>

      <tr>   

        <th width='20'><strong># </strong></th>
        <th><strong>Name </strong></th>        
        <th align="center"><strong>Customer % Discount</strong></th>
        <th><strong>Amount</strong></th>
      </tr>
      <?php $i =1; ?>
      @foreach($clients_customer as $client)
      


      <?php  


    $order = 0;
         
    $order = DB::table('erporders')
           ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
           ->join('clients','erporders.client_id','=','clients.id')           
           ->where('clients.id',$client->id) ->selectRaw('(SUM(price * quantity))-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0)  as total')
           ->pluck('total');

         /*}*/

    $paid = DB::table('clients')
           ->join('payments','clients.id','=','payments.client_id')
           ->where('clients.id',$client->id) ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
           ->pluck('due');

             $due= $order-$paid;
           
           if($due>0){

?>

      <tr>
       <td td width='20'>{{$i}}</td>
        <td> {{ $client->name }}</td>          
        <td> {{ asMoney($due)}}</td>
        </tr>
      <?php $i++;

      } ?>
   
    @endforeach

    </table> -->
  
</div>


</body>

</html>



