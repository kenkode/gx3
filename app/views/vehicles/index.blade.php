@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Vehicles</h4>

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
          <a class="btn btn-info btn-info" href="{{ URL::to('vehicles/create')}}">New Vehicle</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Reg Number</th>
        <th>Model</th>
        <th> Fuel Tank Capacity</th>      
        <th></th>
      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($vehicles as $vehicle)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $vehicle->reg_no }}</td>
          <td>{{ $vehicle->model }}</td>
          <td>{{ $vehicle->tank_capacity }}</td>          
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">

                    

                    <li><a href="{{URL::to('vehicles/edit/'.$vehicle->id)}}">Update</a></li>

                     <li><a href="{{URL::to('vehicles/show/'.$vehicle->id)}}">Show</a></li>
                   
                    <li><a href="{{URL::to('vehicles/delete/'.$vehicle->id)}}"  onclick="return (confirm('Are you sure you want to delete this Vehicle?'))">Delete</a></li>
                    
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