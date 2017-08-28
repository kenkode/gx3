@extends('layouts.payroll')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Employee Allowance</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('employee_allowances/create')}}">new employee allowance</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Employee</th>
        <th>Allowance Type</th>
        <th>Amount</th>
        <th>Action</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($eallws as $eallw)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $eallw->employee->first_name.' '.$eallw->employee->last_name }}</td>
          <td>{{ $eallw->allowance->allowance_name }}</td>
          <td>{{ $eallw->allowance_amount }}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('employee_allowances/edit/'.$eallw->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('employee_allowances/delete/'.$eallw->id)}}">Delete</a></li>
                    
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