@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Stock</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

    @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif
    
    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('stocks/create')}}">Receive Stock </a> &emsp;
          <a class="btn btn-primary btn-sm" href="{{ URL::to('stock/tracking') }}">Track Stocks</a>
          <!-- <a class="btn btn-info btn-sm" href="{{ URL::to('stocks/transfer')}}">Transfer Stock </a> -->
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Item</th>
        <!-- <th>Stock In</th>
        <th>Stock Out</th> -->
        <th>Stock Amount</th>
       <th>Barcode</th> 

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($items as $item)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $item->name }}</td>
               
          <td>{{Stock::getStockAmount($item)}}</td>
           <td>   <dir>

        {{  DNS1D::getBarcodeHTML($item->name, "C128" ,1,13) }}

       </dir>
        <div style="padding-top: 30px; padding-left: 45px;  width: 500px;">
        {{$item->purchase_price}}   Rs{{$item->selling_price}} <br>


        </div>
      

      <style> 
    .code{
        height: 60px !important;
    }

</style>
</td>
       
        </tr>

          
        <?php
        $reorder = (Stock::getStockAmount($item) < $item->reorder_level);
        $message = "Running low on "." ". $item->name." ".$item->description." ."."Please reorder" ;
       

        if ($reorder) 
          
        echo "<script type='text/javascript'> alert('$message');</script>";
           
        $i++; 
        ?>
        @endforeach




      </tbody>


    </table>
  </div>


  </div>

</div>

@stop