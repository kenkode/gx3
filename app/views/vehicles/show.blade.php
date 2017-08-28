@extends('layouts.erp')
@section('content')

<br><div class="row">
  <div class="col-lg-12">
  <h4>Vehicle </h4>  

<hr>
</div>
</div>
  
</div>
<br>
<p>


<div class="row">
  <div class="col-lg-5">

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

    
      
        


    <table  class="table table-condensed table-bordered table-responsive table-hover">

     <tr>
      <td colspan="2"><font color="green">Vehicle Details</font></td>
    </tr>     

     <tr>
       <td>Vehicle Reg. Number</td><td>{{$vehicle->reg_no}}</td>       
     </tr>
      <tr>
       <td>Vehicle Model</td><td>{{$vehicle->model}}</td>
     </tr>
     <tr>
       <td>Fuel Tank Capacity </td><td>{{$vehicle->tank_capacity}}</td>       
     </tr>  
           
    </table>
 </div>


  

</div>

@stop