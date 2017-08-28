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
          <a class="btn btn-info btn-sm" href="{{ URL::to('holidays/create')}}">new holiday</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Holiday Name</th>
        <th>Holiday Date</th>
        <th>Action</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($holidays as $holiday)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $holiday->name }}</td>
          <td>{{ $holiday->date }}</td>
          <td>
            <a href="{{URL::to('holidays/edit/'.$holiday->id)}}">Update</a>| &nbsp;
            <a href="{{URL::to('holidays/delete/'.$holiday->id)}}">Delete</a>           
                    
                    
                 
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

