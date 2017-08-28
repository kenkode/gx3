@extends('layouts.erp')
@section('content')

<br><div class="row">
    <div class="col-lg-12">
  <h3>Generate Barcode</h3>

<hr>
</div>  
</div>

<div class="row">
    <div class="col-lg-5">

    
        
         @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif


       
        <dir>

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
        

  </div>

</div>

@stop