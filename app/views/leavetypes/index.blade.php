@extends('layouts.leave')
@section('content')
<div class="row">
	<div class="col-lg-12">

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('leavetypes/create')}}">new Leave type</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Leave Type</th>
        <th>Days Entitled</th>
        <th>Action</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($leavetypes as $leavetype)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $leavetype->name }}</td>
          <td>{{ $leavetype->days }}</td>
          <td>
            <a href="{{URL::to('leavetypes/edit/'.$leavetype->id)}}">Update</a>| &nbsp;
            <a href="{{URL::to('leavetypes/delete/'.$leavetype->id)}}">Delete</a>           
                    
                    
                 
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

