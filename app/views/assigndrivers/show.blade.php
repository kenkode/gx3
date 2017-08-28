@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Driver Assignment</h4>  

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
      <td colspan="2"><font color="green">Details</font></td>
    </tr>     

       <td>Date </td><td>{{$drivers->date}}</td>
     <tr>
       <td>Time Out</td><td>{{$drivers->time_out}}</td>
     </tr>
     <tr>
       <td>Driver Name</td><td>{{ Assigndriver::drivername($drivers->first_name.' '.$drivers->surname)}}
     </tr>
      <tr>
       <td>Driver Contact</td><td>{{$drivers->contact}}</td>
     </tr>
     <tr>
       <td>Vehicle Reg Number</td><td>{{$drivers->reg_no}}</td>
     </tr>
     <tr>
       <td>Vehicle Model</td><td>{{$drivers->model}}</td>
     </tr>
     <tr>
       <td>Oil Level</td><td>{{$drivers->oil_level}}</td>
     </tr>
     <tr>
       <td>Water Level</td><td>{{$drivers->water_level}}</td>
     </tr>
      <tr>
       <td>Fuel Level</td><td>{{$drivers->fuel_level}}</td>
     </tr>
      <tr>
       <td>Tire (5th Spare Pressure)</td><td>{{$drivers->tire_pressure}}</td>
     </tr>
     <tr>
       <td>General Comments </td><td>{{$drivers->general_comments}}</td> 
     </tr>    

    </table>
 </div> 

</div>

@stop