
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
   margin-bottom: 150px;
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


 @page { margin: 50px 30px; }
 .header { position: top; left: 0px; top: -150px; right: 0px; height: 100px;  text-align: center; }
 .content {margin-top: -100px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px;  }
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

            <img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="50%">
    
        </td>

        <td>
        <strong>
          {{ strtoupper($organization->name)}}
          </strong><br><p>
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
   </div>



<div class="footer">
     <p class="page">Page <?php $PAGE_NUM ?></p>
   </div>


  <div class="content" style='margin-top:0px;'>
   <!-- <div align="center"><strong>Expenditure Report as at {{date('d-M-Y')}}</strong></div><br> -->
   <div align="center"><strong>Vehicles Report as from:  {{$from}} To:  {{$to}}</strong></div><br>



    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>
        


        <th width='20'><strong># </strong></th>
        <th><strong>Date</strong></th>
        <th><strong>Time Out </strong></th>        
        <th><strong>Driver Name</strong></th>
        <th><strong>Vehicle Model</strong></th>
        <th><strong>Vehicle Reg No </strong></th>
        <th><strong>Oil Level </strong></th>
        <th><strong>Water Level </strong></th>
        <th><strong>Fuel Level </strong></th>
        
      </tr>
     <?php $i = 1; ?>
       
         @foreach($assigndrivers as $assigndriver)
        <tr>

          <td> {{ $i }}</td>
          <td>{{ $assigndriver->date }}</td> 
          <td>{{ $assigndriver->time_out }}</td> 
          <td>{{ Assigndriver::drivername($assigndriver->first_name.' '.$assigndriver->surname)}}</td>    
          <td>{{ $assigndriver->model }}</td>                   
          <td>{{ $assigndriver->reg_no }}</td>             
          <td>{{ $assigndriver->oil_level }}</td>
          <td>{{ $assigndriver->water_level }}</td>
          <td>{{ $assigndriver->fuel_level }}</td>          
   
    </tr>

        <?php $i++; ?>
        @endforeach
   
</table>
<br><br>

</div>


</body>

</html>



