@extends('layouts.earning')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Nssf Rates</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('nssf/create')}}">new nssf rate</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Tier</th>
        <th>Income From</th>
        <th>Income To</th>
        <th>Employee Amount</th>
        <th>Employer Amount</th>
        <th>Action</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($nrates as $nrate)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $nrate->tier }}</td>
          <td>{{ $nrate->income_from }}</td>
          <td>{{ $nrate->income_to }}</td>
          <td>{{ $nrate->ss_amount_employee }}</td>
          <td>{{ $nrate->ss_amount_employer }}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('nssf/edit/'.$nrate->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('nssf/delete/'.$nrate->id)}}">Delete</a></li>
                    
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