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

*{
  font-size: 10px !important;
}

th,td{
  padding: 2px 7px !important;
}

div.mods{
  padding: 1% !important;
  width: 100% !important;
}

div.mods:nth-child(odd){
  margin-right: 1%;
  margin-left: 0%;
  background-color: #ffb6c1 !important; 
}

div.mods:nth-child(even){
  margin-left: 1%;
  margin-right: 0%;
}

@page { margin: 170px 20px; }
 .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
 /* .content {margin-top: -120px; margin-bottom: -150px} */
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }


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

img#watermark{
  position: fixed;
  width: 100%;
  z-index: 10;
  opacity: 0.1;
}

</style>


</head>

<body>

<div class="mods col-lg-6">
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
            <strong>{{ strtoupper($organization->name.",")}}</strong><br><br>
            {{ $organization->phone}}<br>
            {{ $organization->email}}<br>
            {{ $organization->website}}<br>
            @for($i=0; $i< count($address); $i++)
            {{ strtoupper($address[$i])}}<br>
            @endfor


            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            <td >
                <strong>Receipt</strong><br><br>
                <table class="demo" style="width:100%">
                  <br><br>
                  <tr >
                    <td>Date</td><td>Receipt #</td>
                  </tr>
                  <tr>
                    <td>{{ date('m/d/Y', strtotime($erporder->date))}}</td><td>{{$erporder->order_number}}</td>
                  </tr>
                  
                </table>
            </td>
          </tr>

          
        
      </table>
      <br>
      PAYBILL NUMBER: 234312
      <table class="demo" style="width:50%">
        <tr>
          <td><strong>{{$erporder->client->type}}</strong></td>
        </tr>
        <tr>
          <td>
            Name:&nbsp; <strong>{{$erporder->client->name}}</strong><br>
            Category:&nbsp; <strong>{{$erporder->client->category}}</strong><br>
            Contact Person:&nbsp; <strong>{{$erporder->client->contact_person}}</strong><br>
            Phone:&nbsp; <strong>{{$erporder->client->phone}}</strong><br>
            Email:&nbsp; <strong>{{$erporder->client->email}}</strong><br>
            Address:&nbsp; <strong>{{$erporder->client->address}}</strong><br>
          </td>
        </tr>
      </table>




      <br>

           <table class="inv" style="width:100%">
          
           <tr>
            <td style="border-bottom:1px solid #C0C0C0">Qty</td>
            <td style="border-bottom:1px solid #C0C0C0">Particulars</td>
            <td style="border-bottom:1px solid #C0C0C0">Collected Cylinders</td>
            <td style="border-bottom:1px solid #C0C0C0">Cylinder Balance</td>         
            <td style="border-bottom:1px solid #C0C0C0">Rate</td>
            <td style="border-bottom:1px solid #C0C0C0">Amount</td>
          </tr>

          <?php $total = 0; $i=1;  $grandtotal=0;
         
         ?>
          @foreach($erporder->erporderitems as $orderitem)

          <?php
            $discount_amount = $orderitem['client_discount'];
            $amount = $orderitem['price'] * $orderitem['quantity'];
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $orderitem->price * $orderitem['quantity']-$discount_amount;


            ?>
          <tr>
            <td>{{ $orderitem->quantity}}</td>
            <td >{{ $orderitem->item->name}}</td>
            <td></td>
            <td></td>
            
            <td>{{ asMoney($orderitem->price-$discount_amount/$orderitem->quantity)}}</td>
            
             <td> {{asMoney(($orderitem->price * $orderitem->quantity)- $discount_amount)}}</td>
          </tr>


      @endforeach
     <!--  @for($i=1; $i<15;$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor -->
          <tr>
            <td style="border-top:1px solid #C0C0C0" rowspan="4" colspan="4">&nbsp;</td>
            
            <td style="border-top:1px solid #C0C0C0" ><strong>Subtotal</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($total)}}</td></tr><tr>

           <!--  <td style="border-top:1px solid #C0C0C0" ><strong>Discount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($orders->discount_amount)}}</td> -->
           
<?php 
$grandtotal = $grandtotal + $total;
$payments = Erporder::getTotalPayments($erporder);


 ?>
           @foreach($txorders as $txorder)
           <?php $grandtotal = $total /*+ $txorder->amount*/; ?>
           <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>{{$txorder->name}}</strong> ({{$txorder->rate.' %'}})</td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($txorder->amount)}}</td>
           </tr>
           @endforeach
            <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>Total Amount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($grandtotal-$orders->discount_amount)}}</td>
           </tr>
           
         


      
      </table>



    
  </div>
<br>
<i><b>Accounts are due on demand</b></i><br>

Received the above goods in good order and condition
<br>
1. Received by: .............................................Signature: ....................................... Date: ......................
<br>
2. Desk: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ Confide::user()->username }}</strong> &emsp;&emsp; Signature: ....................................... Date: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ date('d-m-Y') }}</strong>
<br>
@if($driver !== '')
3. Driver: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ $driver }}</strong> &emsp;&emsp; Signature: ....................................... Date: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ date('d-m-Y') }}</strong>
@else
3. Driver: ....................................................... Signature: ....................................... Date: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ date('d-m-Y') }}</strong>
@endif

</div>
</div>


<div class="footer">
  <p class="page">Page <?php $PAGE_NUM;  ?></p>
</div>

<br><br>
   
   </div>



   <div class="mods col-lg-6">
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
            <strong>{{ strtoupper($organization->name.",")}}</strong><br><br>
            {{ $organization->phone}}<br>
            {{ $organization->email}}<br>
            {{ $organization->website}}<br>
            @for($i=0; $i< count($address); $i++)
            {{ strtoupper($address[$i])}}<br>
            @endfor


            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            <td colspan="2" >
                <strong>Receipt</strong><br><br>
                <table class="demo" style="width:100%">
                  <br><br>
                  <tr >
                    <td>Date</td><td>Receipt #</td>
                  </tr>
                  <tr>
                    <td>{{ date('m/d/Y', strtotime($erporder->date))}}</td><td>{{$erporder->order_number}}</td>
                  </tr>
                  
                </table>
            </td>
          </tr>

          
        
      </table>

      <br>
       PAYBILL NUMBER: 234312
      <table class="demo" style="width:50%">
        <tr>
          <td><strong>{{$erporder->client->type}}</strong></td>
        </tr>
        <tr>
          <td>
            Name:&nbsp; <strong>{{$erporder->client->name}}</strong><br>
            Category:&nbsp; <strong>{{$erporder->client->category}}</strong><br>
            Contact Person:&nbsp; <strong>{{$erporder->client->contact_person}}</strong><br>
            Phone:&nbsp; <strong>{{$erporder->client->phone}}</strong><br>
            Email:&nbsp; <strong>{{$erporder->client->email}}</strong><br>
            Address:&nbsp; <strong>{{$erporder->client->address}}</strong><br>
          </td>
        </tr>
      </table>




      <br>

           <table class="inv" style="width:100%">
          
           <tr>
            <td style="border-bottom:1px solid #C0C0C0">Qty</td>
            <td style="border-bottom:1px solid #C0C0C0">Particulars</td>
            <td style="border-bottom:1px solid #C0C0C0">Collected Cylinders</td>
            <td style="border-bottom:1px solid #C0C0C0">Cylinder Balance</td>         
            <td style="border-bottom:1px solid #C0C0C0">Rate</td>
            <td style="border-bottom:1px solid #C0C0C0">Amount</td>
          </tr>

          <?php $total = 0; $i=1;  $grandtotal=0;
         
         ?>
          @foreach($erporder->erporderitems as $orderitem)

          <?php
            $discount_amount = $orderitem['client_discount'];
            $amount = $orderitem['price'] * $orderitem['quantity'];
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $orderitem->price * $orderitem['quantity']-$discount_amount;


            ?>
          <tr>
            <td>{{ $orderitem->quantity}}</td>
            <td >{{ $orderitem->item->name}}</td>
            <td></td>
            <td></td>
            
            <td>{{ asMoney($orderitem->price-$discount_amount/$orderitem->quantity)}}</td>
            
             <td> {{asMoney(($orderitem->price * $orderitem->quantity)- $discount_amount)}}</td>
          </tr>


      @endforeach
     <!--  @for($i=1; $i<15;$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor -->
          <tr>
            <td style="border-top:1px solid #C0C0C0" rowspan="4" colspan="4">&nbsp;</td>
            
            <td style="border-top:1px solid #C0C0C0" ><strong>Subtotal</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($total)}}</td></tr><tr>

           <!--  <td style="border-top:1px solid #C0C0C0" ><strong>Discount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($orders->discount_amount)}}</td> -->
           
<?php 
$grandtotal = $grandtotal + $total;
$payments = Erporder::getTotalPayments($erporder);


 ?>
           @foreach($txorders as $txorder)
           <?php $grandtotal = $total /*+ $txorder->amount*/; ?>
           <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>{{$txorder->name}}</strong> ({{$txorder->rate.' %'}})</td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($txorder->amount)}}</td>
           </tr>
           @endforeach
            <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>Total Amount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($grandtotal-$orders->discount_amount)}}</td>
           </tr>
      
      </table>

  </div>
<br>
<i><b>Accounts are due on demand</b></i><br>

Received the above goods in good order and condition
<br>
1. Received by: .............................................Signature: ....................................... Date: ......................
<br>
2. Desk: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ Confide::user()->username }}</strong> &emsp;&emsp; Signature: ....................................... Date: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ date('d-m-Y') }}</strong>
<br>
@if($driver !== '')
3. Driver: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ $driver }}</strong> &emsp;&emsp; Signature: ....................................... Date: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ date('d-m-Y') }}</strong>
@else
3. Driver: ....................................................... Signature: ....................................... Date: &emsp;&emsp; <strong style="border-bottom: 1px solid dotted;">{{ date('d-m-Y') }}</strong>
@endif

</div>
</div>


<div class="footer">
  <p class="page">Page <?php $PAGE_NUM;  ?></p>
</div>

<br><br>
   
   </div>


</body>

</html>



