<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<html >

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">

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

th {
  text-align: left;
}
.table {
  width: 100%;
   margin-bottom: 50px;
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



@if(count($erporder) > 0)  
<div class="footer">
     <p class="page">Page <?php $PAGE_NUM ?></p>
</div>

           <br>
           <br> 
            Date: {{ date('m/d/Y')}}<br>
            Name: {{$erporder->client->name}}<br>
            Phone Number: {{$erporder->client->phone}}<br>
            Address: {{$erporder->client->address}}<br><br>            
           <strong>Balance:{{Client::due($erporder->client->id)}}</strong>   

        
      <br>
      <br>
      <div align="center"><strong><h1>Statement</h1></strong></div>
           <br>

           <!-- <table class="inv" style="width:100%"> -->
      <table class="table table-bordered" border='0' cellspacing='0' cellpadding='0' style="width:100%">
          
           <tr>
            <th><strong>Date</strong></th>  
            <th align="center"><strong>Item</strong></th>           
            <th align="right"><strong>Qty</strong></th>  
            <th align="right"><strong>Price</strong></th>  
            <th align="right"><strong>Amount</strong></th>
            <th align="right"><strong>Payment Date</strong></th>  
            <th align="right"><strong>Payment</strong></th>                     
          </tr>

         <?php $total = 0; $client_discount_amt=0; $total_discounted=0;        
         ?>
          @foreach($orders as $orderitem)

          <?php
            $client_discount_amt = $client_discount_amt + $orderitem->discount_amount;
            $client_discount =  $orderitem->client_discount; 
            $amount = $orderitem->price* $orderitem->quantity;
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + ($orderitem->price * $orderitem->quantity)-$client_discount;
            $total_discounted = $total_discounted + ($orderitem->price * $orderitem->quantity)-$client_discount-$orderitem->discount_amount;
            ?>
          <tr>
            
            <td>{{ date("d-M-Y",strtotime($orderitem->date)) }}</td>
            <td align="center">{{ $orderitem->item}}</td>            
            
            <td align="right">{{ $orderitem->quantity}}</td>
            <td align="right">{{ asMoney($orderitem->price-($client_discount/$orderitem->quantity))}}</td>
            
             <td align="right"> {{asMoney(($orderitem->price-($client_discount/$orderitem->quantity)) * $orderitem->quantity)}}</td>
              @endforeach   
            
        </tr>
        <?php
        $payment_amt=0;
        ?>
        @foreach($order_payment as $payment)
            <?php            

            if ($count_payment==0) {
                        $payment_amt=0;
                      } else {
                        $payment_amt = Client::payment($payment->id);
                      }                               
                   
            ?>    
          <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td align="right">{{ date("d-M-Y",strtotime($payment->payment_date)) }}</td>           

          <td align="right">{{asMoney($payment->amount_paid)}}</td>          

          </tr>
          

         @endforeach 
         <tr>
          <td></td>
          <td></td>
          <td></td>
          <td align="right"><strong>Total Amount:</strong></td>
          <td align="right"><strong>{{ asMoney($total)}}</strong></td> 

          </tr>
          <tr>
          <td></td>
          <td></td>
          <td></td>
          <td align="right"><strong>Discount:</strong></td>
          <td align="right"><strong>{{ asMoney($client_discount_amt)}}</strong></td> 

          </tr>
                         
          <tr>
          <td></td>
          <td></td>
          <td></td> 
         <td align="right"><strong>Amount Payable:</strong></td>
         <td align="right"><strong>{{ asMoney($total_discounted)}} </strong></td>
          <td align="right"><strong>Total Payments: </strong></td>
         <td align="right"><strong>{{ asMoney($payment_amt)}} </strong></td></tr>      
                    
      </table>      
         
      </div>
</div>
</div>
<div class="footer">
<p class="page">Page <?php $PAGE_NUM ?></p>
   </div>

@else
  <div align="center"><strong><h1>Whoops! Client has no existing orders</h1></strong></div>
@endif

<br><br>
</body>
</html>



