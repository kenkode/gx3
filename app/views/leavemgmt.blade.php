@extends('layouts.leave')
@section('content')

<br><br>
<div class="row">
											
											
											
        		@if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif				

	<div class="col-lg-12">
	<br>

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('leaveapplications/create')}}">new application</a>
        </div>
        <div class="panel-body">

	<table id="mobile" class="table table-condensed table-bordered table-responsive">

  <thead>
    
    <th>Employee #</th>
    <th>Employee</th>
    <th>Leave Type</th>
    <th>Application Date</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Leave Days</th>
    <th>Balance Days</th>
    <th></th>


  </thead>

  <tbody>

   

        @foreach($leaveapplications as $leaveapplication)
        @if($leaveapplication->status == 'applied')
         <tr>

          <td>{{$leaveapplication->employee->personal_file_number}}</td>
          <td>{{$leaveapplication->employee->first_name." ".$leaveapplication->employee->last_name." ".$leaveapplication->employee->middle_name}}</td>
          <td>{{$leaveapplication->leavetype->name}}</td>
          <td>{{$leaveapplication->application_date}}</td>
           <td>{{$leaveapplication->applied_start_date}}</td>
            <td>{{$leaveapplication->applied_end_date}}</td>
            <td>{{Leaveapplication::getLeaveDays($leaveapplication->applied_end_date,$leaveapplication->applied_start_date)}}</td>

<td>{{Leaveapplication::getBalanceDays($leaveapplication->employee, $leaveapplication->leavetype)}}</td>
          <td>
           <a href="{{URL::to('leaveapplications/edit/'.$leaveapplication->id)}}">Amend</a> &nbsp; |
           @if(Leaveapplication::getBalanceDays($leaveapplication->employee, $leaveapplication->leavetype) >= Leaveapplication::getLeaveDays($leaveapplication->applied_end_date,$leaveapplication->applied_start_date))
          <a href="{{URL::to('leaveapplications/approve/'.$leaveapplication->id)}}">Approve</a> &nbsp;
          @endif
          |&nbsp;<a href="{{URL::to('leaveapplications/reject/'.$leaveapplication->id)}}">Reject</a> &nbsp;|
          <a href="{{URL::to('leaveapplications/cancel/'.$leaveapplication->id)}}">Cancel</a>
          </td>

           </tr>
           @endif
        @endforeach
      

   
    

  </tbody>

        
  </table>
           
      
        </div>
		<hr>

	</div>
</div>

@stop