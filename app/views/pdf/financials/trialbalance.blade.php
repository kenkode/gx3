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

    <!-- <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark"> -->
    
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
          <strong><h3>TRIAL BALANCE AS AT {{$date}} </h3></strong>

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
          <td style="border-bottom:1px solid black;"><strong>Debit</strong></td>
          <td style="border-bottom:1px solid black;"><strong>Credit</strong></td>
           <?php $total_debit =0; $total_credit =0; ?>
        </tr>


        

        @foreach($accounts as $account)
      
        <tr>

          <td style="border-bottom:0.5px solid gray;">{{ $account->name}}</td>

          @if($account->category == 'ASSET' || $account->category == 'EXPENSE' )
          <td style="border-bottom:0.5px solid gray;">{{asMoney(Account::getAccountBalanceAtDate($account, $date))}}</td>
          <td style="border-bottom:0.5px solid gray;">{{asMoney(0)}}</td>

          <?php $total_debit = $total_debit + Account::getAccountBalanceAtDate($account, $date); ?>
          @endif

          @if($account->category == 'LIABILITY' || $account->category == 'INCOME' || $account->category == 'EQUITY')
          <td style="border-bottom:0.5px solid gray;">{{asMoney(0)}}</td>
          <td style="border-bottom:0.5px solid gray;">{{asMoney(Account::getAccountBalanceAtDate($account, $date))}}</td>
         <?php $total_credit= $total_credit + Account::getAccountBalanceAtDate($account, $date); ?>
          @endif
        
          
        </tr>
        
        @endforeach
        <tr>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>TOTAL </strong></td>
          <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>{{asMoney($total_debit)}}</strong></td>
           <td style="border-top:1px solid black; border-bottom:1px solid black;"><strong>{{asMoney($total_credit)}}</strong></td>
          
          

        </tr>      


      </table>    
   </div>
 </body>
 </html>