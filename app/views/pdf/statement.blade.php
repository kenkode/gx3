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
  margin-bottom: 2px;

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
}



img#watermark{
  position: fixed;
  width: 100%;
  z-index: 10;
  opacity: 0.1;
}

</style>


</head>

<!--     <img src="{{ asset('public/uploads/logo/ADmzyppq2eza.png') }}" class="watermark"> -->


<div class="row">



  <div class="col-lg-8">


     <table class="table table-bordered">

      <tr>


       
        <td style="width:150px">

            <img src="{{ '../images/logo.png' }}" alt="{{ $organization->logo }}" width="150px"/>
    
        </td>

        <td>
        <strong>
          {{ strtoupper($organization->name)}}<br>
          </strong>
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



   



    <table class="table table-bordered">

      <tr>


       
        <td>Member:</td><td> {{ $account->member->name}}</td>
      </tr>
      <tr>

        <td>Member #:</td><td> {{ $account->member->membership_no}}</td>

        </tr>
      <tr>
        
        <td>Account :</td><td> {{ $account->account_number}}</td>

      </tr>


      <tr>
        
        <td>Branch :</td><td> {{ $account->member->branch->name}}</td>

      </tr>

      <tr>
        
        <td>Account Balance :</td><td> {{$account->savingproduct->currency." ". asMoney($balance)}}</td>

      </tr>


      <tr>

        <hr>
      </tr>



    </table>

<br><br>

     <table class="table table-bordered">


      <tr>

        <td> <strong> Date </strong></td>
        <td> <strong> Description </strong></td>
        <td><strong> Dr </strong></td>
         <td><strong> Cr </strong></td>

      </tr>

      @foreach($transactions as $transaction) 
      <tr >

        <td>

          <?php 

            $date = date("d-M-Y", strtotime($transaction->date ));
            ?>

          {{ $date}}</td>
        <td>{{ $transaction->description }}</td>

        @if( $transaction->type == 'debit')
          <td >{{ asMoney($transaction->amount)}}</td>
          <td>0.00</td>
          @endif

      @if( $transaction->type == 'credit') 
       <td>0.00</td>
          <td>{{ asMoney($transaction->amount) }}</td>

      @endif

        
      </tr>
      
       @endforeach

      <tr>

        <hr>
      </tr>



    </table>


<br><br>

     

 <p>Thank you for saving with us</p>

   
  </div>

</div>

</html>



