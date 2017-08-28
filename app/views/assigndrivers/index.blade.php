@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Assigned Drivers</h4>

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
          <a class="btn btn-info btn-sm" href="{{ URL::to('assigndrivers/create')}}">Click to Assign Driver</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Date</th>
        <th>Time Out</th>
        <th>Driver Name</th>
        <!-- <th>Driver Contact</th> -->
        <th>Vehicle Model</th>        
        <th>Vehicle Reg No</th>
        <th>Oil Level</th>
        <th>Water Level</th>
        <th>Fuel Level</th>         
        <th></th>

      </thead>
      <tbody>

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
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">

                    

                    <li><a href="{{URL::to('assigndrivers/edit/'.$assigndriver->id)}}">Update</a></li>

                    <li><a href="{{URL::to('assigndrivers/show/'.$assigndriver->id)}}">Show</a></li>
                   
                    <li><a href="{{URL::to('assigndrivers/delete/'.$assigndriver->id)}}"  onclick="return (confirm('Are you sure you want to Delete  this Remove assignment?'))">Remove</a></li>
                    
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>

@stop