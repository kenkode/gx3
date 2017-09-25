@extends('layouts.main')
@section('content')





<br><br>

@if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif
    
                    <div class="row">
                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('employees')}}">
                          <i class="fa fa-users fa-2x"></i>
                          <div>Manage Employess</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('payrollmgmt')}}">
                          <i class="glyphicon glyphicon-credit-card fa-2x"></i>
                          <div>Manage Payroll</div>
                          
                        </a>
                      </div>


                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{URL::to('leavemgmt')}}">
                          <i class="glyphicon glyphicon-tasks fa-2x"></i>
                          <div>Manage Leaves</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('accounts')}}">
                          <i class="glyphicon glyphicon-list fa-2x"></i>
                          <div>Manage Accounting</div>
                          
                        </a>
                      </div>
                      
                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('payrollReports')}}">
                          <i class="glyphicon glyphicon-file fa-2x"></i>
                          <div>Manage Reports</div>
                          
                        </a>
                      </div>

                      
                    </div>
                  



<div class="row">
  
  <div class="col-lg-12">
    <hr>

  </div>
</div>


<div class="row">
  


  <div class="col-lg-12">


   <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('employees/create')}}">new employee</a>
        </div>
        <div class="panel-body">

      <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Personal File Number</th>
        <th>Employee Name</th>
        <th>Employee Branch</th>
        <th>Employee Department</th>

        <th>Action</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($employees as $employee)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $employee->personal_file_number }}</td>
          <td>{{ $employee->first_name.' '.$employee->last_name}}</td>
          <?php if( $employee->branch_id!='0'){ ?>
          <td>{{ $employee->branch->name }}</td>
          <?php }else{?>
          <td></td>
          <?php } ?>
           <?php if( $employee->branch_id!='0'){ ?>
          <td>{{ $employee->department->department_name }}</td>
          <?php }else{?>
          <td></td>
          <?php } ?>
                   <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">

                    <li><a href="{{URL::to('employees/edit/'.$employee->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('employees/delete/'.$employee->id)}}">Delete</a></li>
                    
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


<div class="row">

  <div class="col-lg-12">
    <hr>
  </div>  

  

  
</div>
@stop