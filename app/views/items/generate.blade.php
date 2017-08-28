@extends('layouts.erp')
@section('content')

<br><div class="row">
    <div class="col-lg-12">
  <h3>Barcode Output</h3>

<hr>
</div>  
</div>

<div class="row">
    <div class="col-lg-5">


@foreach($items as $item)
<dir>
{!! DNS1D::getBarcodeHTML($item->name, "C128" ,1,13)!!}
</dir>
<div style="padding-top: 30px; padding-left: 45px; width: 500px;">
{{$item->name}} Ksh{{$item->selling_price}} <br>
  </div>
@endforeach


<style>
.code{
height: 60px !important;
}
</style>
</div>

@stop