
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


    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0' style='width:300px'>
          {{'<tr><td colspan="2" align="center"><strong>PERIOD : '.$period.'</strong></td></tr>'}}
        <tr><td colspan='2'><strong>PERSONAL DETAILS</strong></td></tr>
        @foreach($transacts as $transact)
      <tr><td>Payroll Number:</td><td>{{$transact->personal_file_number}}</td></tr>
      @if($transact->middle_name != null)
      <tr><td>Employee Name: </td><td> {{$transact->last_name.' '.$transact->first_name.' '.$transact->middle_name}}</td>
      @else
      <td>Employee Name: </td><td> {{$transact->last_name.' '.$transact->first_name}}</td>
      @endif
      </tr>
      <tr><td>Identity Number: </td><td>{{$transact->identity_number}}</td></tr>
      <tr><td>Kra Pin: </td>
        @if($transact->pin != null)
        <td>{{$transact->pin}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td>Nssf Number:</td>
        @if($transact->social_security_number != null)
        <td>{{$transact->social_security_number}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td>Nhif Number:</td>
        @if($transact->hospital_insurance_number != null)
        <td>{{$transact->hospital_insurance_number}}</td>
        @else
        <td></td>
        @endif
        </tr>
        @endforeach
        <tr><td><strong>EARNINGS</strong></td>
        @foreach($currencies as $currency)
        <td><strong>Amount ({{$currency->shortname}})</strong></td>
        @endforeach
        </tr>
        @foreach($transacts as $transact)
        <tr><td>Basic Pay: </td><td align='right'>{{ Payroll::asMoney($transact->basic_pay) }}</td></tr>
       @endforeach

        @foreach($earnings as $earning)
        @if($earning->earning_name != null)
        <tr><td>{{ $earning->earning_name }}: </td><td align='right'>{{ Payroll::asMoney($earning->earning_amount) }}</td></tr>
        @else
        @endif
       @endforeach
        
        <tr><td><strong>ALLOWANCES</strong><td></td></td>
        </tr>
        @foreach($allws as $allw)
        @if($allw->allowance_name != null)
        <tr><td>{{ $allw->allowance_name }}: </td><td align='right'>{{ Payroll::asMoney($allw->allowance_amount) }}</td></tr>
        @else
        @endif
       @endforeach

       @foreach($transacts as $transact)
        <tr><td><strong>GROSS PAY: </strong></td><td align='right'>{{ Payroll::asMoney($transact->taxable_income) }}</td></tr>
       @endforeach

       <tr><td><strong>DEDUCTIONS</strong><td></td></td>
        @foreach($transacts as $transact)
        <tr><td>Paye: </td><td align='right'>{{ Payroll::asMoney($transact->paye) }}</td></tr>
        <tr><td>Nssf: </td><td align='right'>{{ Payroll::asMoney($transact->nssf_amount) }}</td></tr>
        <tr><td>Nhif: </td><td align='right'>{{ Payroll::asMoney($transact->nhif_amount) }}</td></tr>
       @endforeach
   
       @foreach($deds as $ded)
        @if($ded->deduction_name != null)
        <tr><td>{{ $ded->deduction_name }}: </td><td align='right'>{{ Payroll::asMoney($ded->deduction_amount) }}</td></tr>
        @else
        @endif
       @endforeach

       @foreach($transacts as $transact)
        <tr><td><strong>TOTAL DEDUCTIONS
            : </strong></td><td align='right'>{{ Payroll::asMoney($transact->total_deductions) }}</td></tr>
       @endforeach

        @foreach($transacts as $transact)
        <tr><td><strong>NET PAY: </strong></td><td align='right'>{{ Payroll::asMoney($transact->net) }}</td></tr>
       @endforeach
    </table><br>
<div style='width:300px'>I certify that the above information is correct and I have  received the payment, in full and final settlement</div>
<br>

 <table >
    <tr><td width="100"><strong>Employee Sign</strong>......................................................</td></tr>
    <tr><td width="100"><strong>Employer Sign</strong>......................................................</td></tr>
    <tr><td width="100"><strong>Date</strong>........................................................................</td></tr>
    <tr><td width="100"><strong>Stamp</strong></td></tr>
  </table>

<br><br>

   
</div>


</body>

</html>



