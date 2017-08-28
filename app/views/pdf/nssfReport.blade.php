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
    <tr><td width="50"><strong>Employer:</strong></td><td>
          {{ strtoupper($organization->name)}}</td></tr>
          {{'<tr><td width="50"><strong>Period</strong> : </td><td>'.$period.'</td></tr>'}}
          <tr><td width="50"><strong>Due Date: </strong></td>
            <td>
            <?php
           $due = 0;
           $year = 0;
           $per = explode("-", $period);
           if($per[0] == 12){
            $due = 1;
            $year = $per[1]+1;
           }else{
            $due = $per[0]+1;
            $year = $per[1];
           }
           echo '09-'.$due.'-'.$year
          ?>
            </td></tr>
          </table>
          <div align="center"><strong>NSSF RETURNS</strong></div><br>

    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>
        <td><strong>Payroll Number </strong></td>
        <td><strong>Employee Name </strong></td>
        <td><strong>ID Number </strong></td>
        <td><strong>Nssf No. </strong></td>
        <td><strong>STD Amt. </strong></td>
        <td><strong>VOL Amt. </strong></td>
        <td><strong>Total Amt. </strong></td>
        <td><strong>Remarks </strong></td>
       
      </tr>
      <?php $i =1; ?>
      @foreach($nssfs as $nssf)
      <tr>
        <td> {{ $nssf->personal_file_number }}</td>
        <td> {{ $nssf->last_name.' '.$nssf->first_name }}</td>
        <td> {{ $nssf->identity_number }}</td>
        <td> {{ $nssf->social_security_number }}</td>
        <td align="right"> {{ asMoney($nssf->nssf_amount*2) }}</td>
        <td align="right">0.00 </td>
        <td align="right"> {{ asMoney($nssf->nssf_amount*2 ) }}</td>
        <td > </td>
        </tr>
      <?php $i++; ?>
   
    @endforeach
    
    <tr><td align="right" colspan='4'><strong>Total: </strong></td><td align="right">{{ asMoney($total*2 ) }}</td><td align="right">0.00</td><td align="right">{{ asMoney($total*2 ) }}</td><td></td></tr>

    </table>

<br><br>

   
</div>


</body>

</html>



