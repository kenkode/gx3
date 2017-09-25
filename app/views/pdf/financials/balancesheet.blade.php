<html>
  <head>
   <style>
     @page { margin: 170px 30px; }
     .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
     .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
     .footer .page:after { content: counter(page, upper-roman); }
     /* .content { margin-top: -70px;  } */
      

table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
}

th,td{
  padding: 2px 7px !important;
}

      img#watermark{
        position: fixed;
        width: 100%;
        z-index: 10;
        opacity: 0.1;
      }

   </style>
  <body style="font-size:10px">
<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

<!--     <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark">? -->
   <div class="header">
     <table >

      <tr>


       
        <td style="width:150px">

            <img src="{{ '../images/logo.png' }}" alt="{{ $organization->logo }}" width="90px"/>
    
        </td>

        <td>
        <strong>
          {{ strtoupper($organization->name)}}<br>
          </strong>
          {{ $organization->phone}} |
          {{ $organization->email}} |
          {{ $organization->website}}<br>
          {{ $organization->address}}
       

        </td>

        <td>
          <strong><h3>BALANCE SHEET AS AT {{$date}} </h3></strong>

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



   <div class="content">
     

      <table class="table table-bordered" style="width:100%">

        <tr>

          <td style="border-bottom:1px solid black;"><strong>Account Description</strong></td>
          <td style="border-bottom:1px solid black;"><strong>Amount</strong></td>
         

        </tr>


        <tr>
          <td style="border-bottom:1px solid black;"><strong>ASSETS</strong></td>
          <td style="border-bottom:1px solid black;"></td>
          
            <?php $total_assets =0; ?>

        </tr>


        @foreach($accounts as $account)
        @if($account->category == 'ASSET')
        <tr>

          <td style="border-bottom:0.5px solid gray;">{{ $account->name}}</td>
          <td style="border-bottom:0.5px solid gray;">{{asMoney(Account::getAccountBalanceAtDate($account, $date))}}</td>
        
          <?php $total_assets = $total_assets + Account::getAccountBalanceAtDate($account, $date); ?>
        </tr>
        @endif
        @endforeach
        <tr>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>TOTAL ASSETS</strong></td>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>{{asMoney($total_assets)}}</strong></td>
          
          

        </tr>

<tr>
<td><br></td>
</tr>


         <tr>
          <td style="border-bottom:1px solid black;"><strong>LIABILITIES</strong></td>
          <td style="border-bottom:1px solid black;"></td>
          
            <?php $total_liabilities =0; ?>

        </tr>


        @foreach($accounts as $account)
        @if($account->category == 'LIABILITY')
        <tr>

          <td style="border-bottom:0.5px solid gray;">{{ $account->name}}</td>
          <td style="border-bottom:0.5px solid gray;">{{asMoney(Account::getAccountBalanceAtDate($account, $date))}}</td>
        
          <?php $total_liabilities = $total_liabilities + Account::getAccountBalanceAtDate($account, $date); ?>
        </tr>
        @endif
        @endforeach
        <tr>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>TOTAL LIABILITIES</strong></td>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>{{asMoney($total_liabilities)}}</strong></td>
          
          

        </tr>




        </tr>

<tr>
<td><br></td>
</tr>


         <tr>
          <td style="border-bottom:1px solid black;"><strong>EQUITIES</strong></td>
          <td style="border-bottom:1px solid black;"></td>
          
            <?php $total_equity =0; ?>

        </tr>


        @foreach($accounts as $account)
        @if($account->category == 'EQUITY')
        <tr>

          <td style="border-bottom:0.5px solid gray;">{{ $account->name}}</td>
          <td style="border-bottom:0.5px solid gray;">{{asMoney(Account::getAccountBalanceAtDate($account, $date))}}</td>
        
          <?php $total_equity = $total_equity + Account::getAccountBalanceAtDate($account, $date); ?>
        </tr>
        @endif
        @endforeach
        <tr>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>TOTAL EQUITIES</strong></td>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>{{asMoney($total_equity)}}</strong></td>
          
          

        </tr>


       


      </table>















    
   </div>








 </body>
 </html>