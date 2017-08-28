<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<html >



<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
   
   

<style>

@page { margin: 170px 20px; }
 .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: -120px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }



table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th,td{
  padding: 2px 7px !important;
}

  .demo {
    border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:0px;
  }
  .demo th {
    border:1px solid #C0C0C0;
    padding:5px;
  }
  .demo td {
    border:1px solid #C0C0C0;
    padding:5px;
  }


  .inv {
    border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:0px;
  }
  .inv th {
    border:1px solid #C0C0C0;
    padding:5px;
  }
  .inv td {
    border-bottom:0px solid #C0C0C0;
    border-right:1px solid #C0C0C0;
    padding:5px;
  }

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
<div class="content">

<div class="row">
  <div class="col-lg-12">

  <?php

  $address = explode('/', $organization->address);

  ?>

      <table class="" style="border: 0px; width:100%">

          <tr>

            <td style="width:150px">

            <img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="50%">
    
        </td>
          
            <td >
            {{ strtoupper($organization->name.",")}}<br>
            @for($i=0; $i< count($address); $i++)
            {{ strtoupper($address[$i])}}<br>
            @endfor


            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            <td colspan="2" >
                  <strong>Statement</strong>
                <table class="demo" style="width:100%">              
                  
                  <tr>
                    <td>{{ date('m/d/Y', strtotime($erporder->date))}}</td>
                  </tr>
                  
                </table>
            </td>
          </tr>

          
        
      </table>
      <br>
      <table class="demo" style="width:40%">
        <tr>
          <td><strong>Client</strong></td>
        </tr>
        <tr>
          <td>{{$erporder->client->name}}<br>
          {{$erporder->client->contact_person}}<br>
           {{$erporder->client->phone}}<br>
            {{$erporder->client->email}}<br>
            {{$erporder->client->address}}<br>
            <strong>Balance:{{Client::payment($erporder->client->id)}}</strong>
          </td>
        </tr>
      </table>




      <br>

           <table class="inv" style="width:100%">
          
           <tr>
            <th><strong>Date</strong></th>  
            <th><strong>Item</strong></th>           
            <th><strong>Qty</strong></th>  
            <th align="right"><strong>Price</strong></th>  
            <th align="right"><strong>Amount</strong></th>  
            <th align="right"><strong>Payment Date</strong></th>  
            <th align="right"><strong>Payment</strong></th>          
          </tr>

         <?php $total = 0; $i=1;  $grandtotal=0;
         $discount_amount = Session::get('erporder')['percentage_discount'];
         ?>
          @foreach($orders as $orderitem)

          <?php

            $amount = $orderitem->price* $orderitem->quantity;
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + ($orderitem->price-$discount_amount/100*$orderitem->price) * $orderitem->quantity;


            ?>
          <tr>
            
            <td>{{ date("d-M-Y",strtotime($orderitem->date)) }}</td>
            <td >{{ $orderitem->item}}</td>
            
            
            <td align="center">{{ $orderitem->quantity}}</td>
            <td align="right">{{ asMoney($orderitem->price-$discount_amount/100*$orderitem->price)}}</td>
            
             <td align="right"> {{asMoney(($orderitem->price-$discount_amount/100*$orderitem->price) * $orderitem->quantity)}}</td>           
            

           @endforeach            

            @foreach($order_payment as $payment)
            <?php
            $payment_amt = Client::payment($payment->id)

            ?>          

          <td align="right">{{ date("d-M-Y",strtotime($payment->payment_date)) }}</td>             

          <td align="right">{{asMoney($payment->amount_paid)}}</td>

          </tr> 

          @endforeach  
      <!-- @for($i=1; $i<15;$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor -->
          <tr>
            <td style="border-top:1px solid #C0C0C0" rowspan="4" colspan="3">&nbsp;</td>
            
            <td style="border-top:1px solid #C0C0C0" ><strong>Total Amount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($total)}}</td></tr><tr>

            <td style="border-top:1px solid #C0C0C0" ><strong>Total Payments:</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{ asMoney($payment_amt)}}</td>

            <td style="border-top:1px solid #C0C0C0" ><strong>Balance::</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($total-$payment_amt)}}</td>       
    
      </table>
    
  </div>
</div>
</div>
<div class="footer">
     <p class="page">Page <?php $PAGE_NUM ?></p>
   </div>

<br><br>  

</body>

</html>



