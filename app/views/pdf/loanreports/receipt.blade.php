
<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<html>
  <head>
   <style>
     @page { margin: 170px 30px; }
     .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
     .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
     .footer .page:after { content: counter(page, upper-roman); }
     

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
  <body>

<!--     <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark"> -->
    
   <div class="header">
     <table >

      <tr>


       
        <td style="width:150px">

            <img src="{{ '../images/logo.png' }}" alt="{{ $organization->logo }}" width="150px"/>
    
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


    <table class="table table-bordered">

      <tr>


       
        <td>Member:</td><td> {{ $transaction->loanaccount->member->name}}</td>
      </tr>
      <tr>

        <td>Member #:</td><td> {{ $transaction->loanaccount->member->membership_no}}</td>

        </tr>
      <tr>
        
        <td>Account :</td><td> {{ $transaction->loanaccount->account_number}}</td>

      </tr>


      <tr>
        
        <td>Branch :</td><td> {{ $transaction->loanaccount->member->branch->name}}</td>

      </tr>


      <tr>

        <hr>
      </tr>



    </table>

<br><br>

     <table class="table table-bordered">


      <tr style="padding:20px">

        <td style="padding:10px"> <strong> Date </strong></td>
        <td style="padding:10px"> <strong> Description </strong></td>
        <td style="padding:10px"><strong> Amount </strong></td>

      </tr>

      <tr style="padding:20px">

        <td style="padding:10px; width:100px">{{ $transaction->date }}</td>
        <td style="padding:10px">{{ $transaction->description }}</td>
        <td style="padding:10px">{{ asMoney($transaction->amount )}}</td>
       
        
      </tr>
      


      <tr>

        <hr>
      </tr>



    </table>


<br><br>
     
     <p style="page-break-before: always;"></p>
   </div>
 </body>
 </html>