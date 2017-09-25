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
    width: 100px;
    margin-top: -100px;
    border: 0;
    border-top: 1px solid #000;
    padding: 0;
}

.hr3 {
  display: block;
    height: 1px;
    width: 100px;
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


	<div class="content" style='margin-top:0px;'>
    <table>
    <?php if(!empty($selBranch) && !empty($selDept)){?>
     <tr><td width='50'><strong>Branch:</strong></td><td>All</td></tr>
     <tr><td width='50'><strong>Department:</strong></td><td>All</td></tr>
    <?php }else if(!empty($selBranch)){?>
     <tr><td width='50'><strong>Branch:</strong></td><td>All</td></tr>
     <tr><td width='50'><strong>Department:</strong></td><td>{{$sels->department_name}}</td></tr>
    <?php }else if(!empty($selDept)){?>
     <tr><td width='50'><strong>Branch:</strong></td><td>{{$sels->name}}</td></tr>
     <tr><td width='50'><strong>Department:</strong></td><td>All</td></tr>
     <?php }else if(empty($selDept) && empty($selBranch)){?>
     <tr><td width='50'><strong>Branch:</strong></td><td>{{$selBr->name}}</td></tr>
     <tr><td width='50'><strong>Department:</strong></td><td>{{$selDt->department_name}}</td></tr>
    <?php } ?> 
    <tr><td width='50'>
     <strong>Currency:</strong></td>
      @foreach($currencies as $currency)
     <td>{{$currency->shortname}}
      @endforeach   
      </tr>
      <tr><td width='50'><strong>Period:</strong></td><td>{{$period}}</td></tr>
      </table>
   <div style="margin-bottom:20px" align="center"><strong>PAYROLL SUMMARY</strong></div>

    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>

        <td width='20'><strong># </strong></td>
        <td><strong>Payroll Number </strong></td>
        <td><strong>Employee Name </strong></td>
        <td><strong>Basic Pay </strong></td>
        <td><strong>Allowance </strong></td>
        <td><strong>Gross Pay </strong></td>
        <td><strong>Paye</strong></td>
        <td><strong>Nssf Amount</strong></td>
        <td><strong>Nhif Amount</strong></td>
        <td><strong>Other Deductions</strong></td>
        <td><strong>Total Deductions </strong></td>  
        <td><strong>Net Pay </strong></td>    
      </tr>
      <?php $i =1; ?>
      @foreach($sums as $sum)
      <tr>


       <td td width='20'>{{$i}}</td>
        <td> {{ $sum->personal_file_number }}</td>
        <td> {{ $sum->last_name.' '.$sum->first_name }}</td>
        <td align="right"> {{ asMoney($sum->basic_pay) }}</td>
        <td align="right"> {{ asMoney($sum->earning_amount) }}</td>
        <td align="right"> {{ asMoney($sum->taxable_income) }}</td>
        <td align="right"> {{ asMoney($sum->paye) }}</td>
        <td align="right"> {{ asMoney($sum->nssf_amount) }}</td>
        <td align="right"> {{ asMoney($sum->nhif_amount) }}</td>
        <td align="right"> {{ asMoney($sum->other_deductions) }}</td>
        <td align="right"> {{ asMoney($sum->total_deductions) }}</td>
        <td align="right"> {{ asMoney($sum->net ) }}</td>
        </tr>
      <?php $i++; ?>
   
    @endforeach
    
    <tr><td colspan='3' align="right"><strong>Total: </strong></td>

    <td align="right" width="69">{{ asMoney($total_pay ) }}</td>
    <td align="right" width="72">{{ asMoney($total_earning ) }}</td>
    <td align="right" width="73">{{ asMoney($total_gross ) }}</td>
    <td align="right" width="69">{{ asMoney($total_paye ) }}</td>
    <td align="right" width="62">{{ asMoney($total_nssf ) }}</td>
    <td align="right" width="63">{{ asMoney($total_nhif ) }}</td>
    <td align="right" width="77">{{ asMoney($total_others ) }}</td>
    <td align="right" width="78">{{ asMoney($total_deds ) }}</td>
    <td align="right" width="68">{{ asMoney($total_net ) }}</td></tr>

     
    <td align="right" colspan='11'><strong>Total net:</strong></td><td align="right" width="68">{{ asMoney($total_net ) }}</td></tr>

    </table>

<br><br>
    <table >
    <tr><td width="100"><strong>Prepared By:</strong></td>
    <td width="300"><hr class="hr1"></td> <td width="150"><hr class="hr1" style="width:150px"></td><td width="150"><hr class="hr1" style="width:150px"></td></tr>
    <tr><td></td><td align="center"><strong>Name</strong></td><td align="center"><strong>Signature</strong></td><td align="center"><strong>Date</strong></td></tr>
    <tr><td height="20"></td></tr>
     <tr><td width="100"><strong>Approved By:</strong></td><td width="300"><hr class="hr1"></td> <td width="150"><hr class="hr1" style="width:150px"></td><td width="150"><hr class="hr1" style="width:150px"></td></tr>
    <tr><td></td><td align="center"><strong>Name</strong></td><td align="center"><strong>Signature</strong></td><td align="center"><strong>Date</strong></td></tr>
     <tr><td height="20"></td></tr>
     <tr><td width="100"><strong>Authorized By:</strong></td><td width="300"><hr class="hr1"></td> <td width="150"><hr class="hr1" style="width:150px"></td><td width="150"><hr class="hr1" style="width:150px"></td></tr>
   <tr><td></td><td align="center"><strong>Name</strong></td><td align="center"><strong>Signature</strong></td><td align="center"><strong>Date</strong></td></tr>
    </table>

<br><br>

   
</div>


</body>

</html>



