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

.hr1 {
  display: block;
    height: 1px;
    width: 300px;
    border: 0;
    border-top: 1px solid #000;
    padding: 0;
}

.hr2 {
  display: block;
    height: 1px;
    width: 300px;
    margin-top: -100px;
    border: 0;
    border-top: 1px solid #000;
    padding: 0;
}

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 12px;
  line-height: 1.428571429;
  color: #333;
  background-color: #fff;
}



 @page { margin: 170px 30px; }
 .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: -100px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }



img#watermark{
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


	<div class="content" style='margin-top:0px;'>
    <table>
    <?php
     $banks=DB::table('banks')
            ->where('organization_id','=',$organization->id)
            ->where('id','=',$organization->bank_id)
            ->get();
    ?>

      @if($organization->bank_id != 0)
      @foreach($banks as $bank)
    <tr><td width='80'><strong>Bank Name:</strong></td><td>{{ $bank->bank_name}}</td></tr>
     @endforeach
      @else
    <tr><td width='80'><strong>Bank Name:</strong></td><td></td></tr>
       @endif
    @foreach($branches as $branch)
     @if($organization->bank_branch_id != 0)
   <tr><td width='50'><strong>Bank Branch:</strong></td><td>{{$branch->bank_branch_name}}</td></tr>
     @else
    <tr><td width='80'><strong>Bank Name:</strong></td><td></td></tr>
     @endif
   @endforeach
    <tr><td width='80'><strong>Bank Account:</strong></td><td>{{ $organization->bank_account_number}}</td></tr>
    <tr><td width='80'><strong>Swift Code:</strong></td><td>{{ $organization->swift_code}}</td></tr>
     <tr>
      @foreach($currencies as $currency)
     <td width='80'><strong>Currency : </strong></td><td>{{$currency->shortname}}</td></tr>
     @endforeach 
    </tr>
     <tr><td width='80'><strong>Period:</strong></td><td>{{ $period }}</td></tr>

    </table>
   <div align="center" style="margin-bottom:20px"><strong>SALARY TRANSFER LETTER</strong></div>

    <div style="margin-bottom:10px">Please arrange to transfer funds to the below listed employees` respective bank accounts</div>

    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>

        <td width='20'><strong># </strong></td>
        <td><strong>Payroll Number </strong></td>
        <td><strong>Employee Name </strong></td>
        <td><strong>ID Number </strong></td>
        <td><strong>Bank </strong></td>
        <td><strong>Bank Branch</strong></td>
        <td><strong>Bank Account</strong></td>
        <td><strong>Swift Code</strong></td>
        <td><strong>Amount</strong></td>    
      </tr>
      <?php $i =1; ?>
      @foreach($rems as $rem)
      <tr>


       <td td width='20'>{{$i}}</td>
        <td> {{ $rem->personal_file_number }}</td>
        <td> {{ $rem->last_name.' '.$rem->first_name }}</td>
        <td> {{ $rem->identity_number }}</td>
        @if($rem->bank_id != 0)

        <?php $banks = DB::table('banks')
            ->join('employee', 'banks.id', '=', 'employee.bank_id')
            ->where('banks.id','=',$rem->bank_id)
            ->get(); 
            ?>
        @foreach($banks as $bank)
        <td> {{ $bank->bank_name }}</td>
        @endforeach
        @else
        <td></td>
        @endif

        @if($rem->bank_branch_id != 0)
        <?php $bbranches = DB::table('bank_branches')
            ->join('employee', 'bank_branches.id', '=', 'employee.bank_branch_id')
            ->where('bank_branches.id','=',$rem->bank_branch_id)
            ->get(); 
            ?>
        @foreach($bbranches as $bbranch)
        <td> {{ $bbranch->bank_branch_name }}</td>
        @endforeach
        @else
        <td></td>
        @endif
        @if($rem->bank_account_number != null)
        <td> {{ $rem->bank_account_number }}</td>
         @else
        <td></td>
        @endif
        @if($rem->swift_code != null)
        <td> {{ $rem->swift_code }}</td>
         @else
        <td></td>
        @endif
        <td align="right"> {{ asMoney($rem->net ) }}</td>
        </tr>
      <?php $i++; ?>
   
    @endforeach
    
  
    <tr><td align="right" colspan='8'><strong>Total Remittances: </strong></td><td align="right" >{{ asMoney($total ) }}</td></tr>     

    </table>

    <div>Please debit our account with your bank charges and confirm once the above transfer has been made.</div>

<br>
    <div>
    <strong>Authorized Signatory</strong><strong style="margin-left:500px;"> Authorized Signatory</strong>
    </div>
  <br><br>
  <div>
  <hr style="margin-left:-0px;" class="hr1"><hr style="margin-left:620px;" class="hr2">
     </div>

      <div>
    <strong>Name</strong><strong style="margin-left:590px;">Name</strong>
    </div>
   

  <br><br>
  <div>

    <hr style="margin-left:-0px;" class="hr1"><hr style="margin-left:620px;" class="hr2">
     </div>
      <div>
    <strong>Signature</strong><strong style="margin-left:565px;">Signature</strong>
    </div>
  <br>

<br><br>

   
</div>


</body>

</html>



