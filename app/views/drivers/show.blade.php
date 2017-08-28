@extends('layouts.erp')
@section('content')

<br><div class="row">
  <div class="col-lg-12">
  <h4>Driver Record </h4>  

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
      <td colspan="2"><font color="green">Driver Details</font></td>
      </tr>     

     <tr>
       <td>Surname</td><td>{{$driver->surname}}</td>       
     </tr>
     <tr>
       <td>First Name</td><td>{{$driver->first_name}}</td>       
     </tr>
     <tr>
       <td>Other Names</td><td>{{$driver->other_names}}</td>       
     </tr>
      <tr>
       <td>Phone Number</td><td>{{$driver->contact}}</td>
     </tr>
     <tr>
       <td>Employee Number </td><td>{{$driver->employee_no}}</td>       
     </tr> 
    </table>
 </div>


  

</div>

@stop