<html>
  <head>
     
   <style>
     @page { margin: 170px 30px; }
     .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
     .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
     .footer .page:after { content: counter(page, upper-roman); }
     .content { margin-top: -70px;  }
      

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

        <td>
          <strong><h3>LOAN STATEMENT </h3></strong>

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
     

      <table class="table table-bordered" style="width:60%">

       
          <tr>
            <td style="width:17%">Member</td><td>{{ucwords($account->member->name)}}</td>

          </tr>

          <tr>
            <td>Member #</td><td>{{ucwords($account->member->membership_no)}}</td>

          </tr>
          <tr>
            <td>Loan #</td><td>{{$account->account_number}}</td>

          </tr>


          <tr>
            <td>Loan Amount</td><td>{{asMoney($account->amount_disbursed)}}</td>

          </tr>

         <!--
          <tr>
            <td>Interest Amount</td><td>{{asMoney(Loanaccount::getInterestAmount($account))}}</td>

          </tr>
        -->

       


      </table>
      <br><br>


      <table class="table table-bordered" style="width:100%">



          <tr style="font-weight:bold">
              <td>Date</td>
              <td>Description</td>
              <td>Principal</td>
             <td>Interest</td> 
              <td>Principal Balance</td>
             <!--  <td>Interest Balance</td> -->
          </tr>

          <tbody>



             <tr>

                <td>

                  <?php 

            $date = date("d-M-Y", strtotime($account->date_disbursed));
            ?>

                  {{$date}}</td>
                <td>Loan disbursed </td>
                <td>{{asMoney($account->amount_disbursed)}}</td>
                <td>{{asMoney(0)}}</td> 
                <td>{{asMoney($account->amount_disbursed)}}</td>
               <!-- <td>{{asMoney(Loanaccount::getInterestAmount($account))}}</td> -->

              </tr>


              <?php 

              $repayments = DB::table('loanrepayments')->where('loanaccount_id', '=', $account->id)->get(); 

              $principal_balance = $account->amount_disbursed;
              $interest_balance = Loanaccount::getInterestAmount($account);

              $prinpaid = 0;
              $intpaid = 0;
            ?>

            @foreach($repayments as $repayment)


                <tr>

                  <td>

                    <?php 

            $date = date("d-M-Y", strtotime($repayment->date));
            ?>

                    {{$date}}</td>
                  <td>

                    @if($repayment->principal_paid > 0) Principal repayment @endif
                    @if($repayment->interest_paid > 0) Interest repayment @endif

                  </td>
                  <td>

                    <?php $prinpaid = $prinpaid + $repayment->principal_paid; ?>
                    {{asMoney($repayment->principal_paid)}}</td>
                  <td>

                    <?php $intpaid = $intpaid + $repayment->interest_paid; ?>
                    {{asMoney($repayment->interest_paid)}}</td>
                  <td>{{asMoney($principal_balance = $principal_balance - $repayment->principal_paid)}}</td>
                 <!-- <td>{{asMoney($interest_balance = $interest_balance - $repayment->interest_paid)}}</td> -->


                </tr>

            @endforeach

            <tr>
              <td></td>
              <td style=" font-weight:bold">Total Repayments</td>
              <td style="border-top:2px solid black; font-weight:bold">{{ asMoney($prinpaid)}}</td>
              <td style="border-top:2px solid black;font-weight:bold">{{ asMoney($intpaid)}}</td>
              <td></td>


            </tr>



          </tbody>
      </table>















    
   </div>








 </body>
 </html>