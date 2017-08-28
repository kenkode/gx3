@extends('layouts.leave')
@section('content')
<div class="row">
	<div class="col-lg-12">
 

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

	<table class="table table-responsive table-bordered table-condensed">
   
   <tr>
   <td><strong>Employee</strong></td><td>{{$leaveapplication->employee->first_name.' '.$leaveapplication->employee->last_name.' '.$leaveapplication->employee->middle_name}}</td>
     
   </tr> 

   <tr>
   <td><strong>Leave Type</strong></td><td>{{$leaveapplication->leavetype->name}}</td>
     
   </tr> 

   <tr>
   <td><strong>Application Date</strong></td><td>{{date('d-M-Y', strtotime($leaveapplication->application_date))}}</td>
     
   </tr> 


    <tr>
   <td><strong>Applied Start Date</strong></td><td>{{date('d-M-Y', strtotime($leaveapplication->applied_start_date))}}</td>
     
   </tr>

    <tr>
   <td><strong>Applied End Date</strong></td><td>{{date('d-M-Y', strtotime($leaveapplication->applied_end_date))}}</td>
     
   </tr>


   

  </table>




  <form method="POST" action="{{{ URL::to('leaveapplications/approve/'.$leaveapplication->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

        
        <div class="form-group">
                        <label for="username">Approved Start Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21"  placeholder="" type="text" name="approved_start_date" id="approved_start_date" value="{{$leaveapplication->applied_start_date}}">
                    </div>
       </div>



       <div class="form-group">
                        <label for="username">Approved End Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21"  placeholder="" type="text" name="approved_end_date" id="approved_end_date" value="{{$leaveapplication->applied_end_date}}">
                    </div>
       </div>


        

      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Approve</button>
        </div>

    </fieldset>
</form>
    
		

  </div>

</div>
@stop


