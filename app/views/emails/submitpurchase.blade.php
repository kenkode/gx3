

<p>
Hello {{$name}}, 
</p>

<p>Please review the following purchase order prepared by {{$username}}: </p>
<table class="inv" style="width:100%">
          
           

           <tr>
            <td style="border-bottom:1px solid #C0C0C0">Item</td>
            <td style="border-bottom:1px solid #C0C0C0">Description</td>
            
            <td style="border-bottom:1px solid #C0C0C0">Qty</td>
            <td style="border-bottom:1px solid #C0C0C0">Rate</td>
           
            <td style="border-bottom:1px solid #C0C0C0">Amount</td>
          </tr>

         <?php $total = 0; $i=1;  $grandtotal=0;?>
          @foreach($erporder->erporderitems as $orderitem)

          <?php

            $amount = $orderitem['price'] * $orderitem['quantity'];
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $amount;


            ?>
          <tr>
            <td >{{ $orderitem->item->item_make}}</td>
            <td>{{ $orderitem->item->description}}</td>
            
            <td>{{ $orderitem->quantity}}</td>
            <td>{{ number_format($orderitem->price,2)}}</td>
            
             <td> {{number_format(($orderitem->price * $orderitem->quantity),2)}}</td>
          </tr>


      @endforeach
      @for($i=1; $i<10;$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor
          <tr>
            <td style="border-top:1px solid #C0C0C0" rowspan="4" colspan="3">&nbsp;</td>
            
            <td style="border-top:1px solid #C0C0C0" ><strong>Subtotal</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{number_format($total,2)}}</td>
           
<?php 
$grandtotal = $grandtotal + $total;
$payments = Erporder::getTotalPayments($erporder);


 ?>
           @foreach($txorders as $txorder)
           <?php $grandtotal = $total + $txorder->amount; ?>
           <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>{{$txorder->name}}</strong> ({{$txorder->rate.' %'}})</td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{number_format($txorder->amount,2)}}</td>
           </tr>
           @endforeach
            <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>Total Amount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{number_format($grandtotal,2)}}</td>
           </tr>
           
         


      
      </table>
<br>
<p>Please login to review purchase order</p>
<p><a href="{{URL::to('/')}}">Login</a></p>
<br><br>
<p>Regards,</p>
<p>Gas Express</p>