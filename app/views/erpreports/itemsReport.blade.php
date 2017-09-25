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
          </strong><br>
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
   <!-- <div align="center"><strong>Items Report as at {{date('d-M-Y')}}</strong></div><br> -->
   <div align="center"><strong>Items Report as from:  {{$from}} To:  {{$to}}</strong></div><br>

    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>
        


        <th width='20'><strong># </strong></th>
        <th><strong>Tag Id </strong></th>
        <th><strong>Name </strong></th>
        <th><strong>Description </strong></th>
        <th><strong>Purchase Price </strong></th>
        <th><strong>Selling Price </strong></th>
       <!--  <th><strong>Store Keeping Unit </strong></th> -->
        <th><strong>Reorder Level </strong></th>
      </tr>
      <?php $i =1; ?>
      @foreach($items as $item)
      <tr>


       <td td width='20' valign="top">{{$i}}</td>
        <td valign="top"> {{ $item->tag_id }}</td>
        <td valign="top"> {{ $item->item_make }}</td>
        <td valign="top"> {{ $item->description }}</td>
        <td valign="top" align="right"> {{ asMoney($item->purchase_price) }}</td>
        <td valign="top" align="right"> {{ asMoney($item->selling_price) }}</td>
        <!-- <td valign="top"> {{ $item->sku }}</td> -->
        <td valign="top" align="center"> {{ $item->reorder_level }}</td>
        </tr>
      <?php $i++; ?>
   
    @endforeach

     

    </table>

<br><br>

   
</div>


</body>

</html>



