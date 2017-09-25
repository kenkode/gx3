@extends('layouts.organization')
@section('content')
<br/><br/>

<div class="row">
	<div class="col-lg-12">

&nbsp;&nbsp;&nbsp;
<button class="btn btn-info btn-xs " data-toggle="modal" data-target="#organization">update email configurtion details</button>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-3">


<img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="50%">


</div>	


<div class="col-lg-7 ">

	<table class="table table-bordered table-hover">

		<tr>

			<td> Smtp </td><td>{{$organization->smtp}}</td>

		</tr>

		<tr>

			<td> Phone </td><td>{{$organization->phone}}</td>

		</tr>

		<tr>

			<td>  Website</td><td>{{$organization->website}}</td>

		</tr>

		<tr>

			<td> Address </td><td>{{$organization->address}}</td>

		</tr>

    <tr>

      <td> Kra Pin </td><td>{{$organization->kra_pin}}</td>

    </tr>

    <tr>

      <td> Nssf Number </td><td>{{$organization->nssf_no}}</td>

    </tr>
		
    <tr>

      <td> Nhif Number </td><td>{{$organization->nhif_no}}</td>

    </tr>

    <tr>
      @foreach($banks as $bank)
      <td> Bank </td><td>{{$bank->bank_name}}</td>
      @endforeach
    </tr>

    <tr>
      @foreach($bbranches as $bbranch)
      <td> Bank Branch </td><td>{{$bbranch->bank_branch_name}}</td>
      @endforeach
    </tr>

    <tr>

      <td> Bank Account Number </td><td>{{$organization->bank_account_number}}</td>

    </tr>

    <tr>

      <td> Swift Code </td><td>{{$organization->swift_code}}</td>

    </tr>

	</table>


</div>	



</div>

<div class="row">
	<div class="col-lg-12">


<hr>
</div>	
</div>










<!-- organizations Modal -->
<div class="modal fade" id="organization" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Email Organization Details</h4>
      </div>
      <div class="modal-body">


      	
      	<form method="POST" action="{{{ URL::to('organizations/update/'.$organization->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label > Driver</label>
            <input class="form-control" placeholder="" type="text" name="driver" id="driver" value="{{ $organization->driver }}">
        </div>
        
        <div class="form-group">
            <label > Host</label>
            <input class="form-control" placeholder="" type="text" name="host" id="host" value="{{ $organization->host }}">
        </div>

        <div class="form-group">
            <label > Port</label>
            <input class="form-control" placeholder="" type="text" name="port" id="port" value="{{ $organization->port }}">
        </div>

        <div class="form-group">
            <label > From email </label>
            <input class="form-control" placeholder="" type="text" name="from_email" id="from_email" value="{{ $organization->from_email }}">
        </div>
        

        <div class="form-group">
            <label > From Name</label>
           <input class="form-control" placeholder="" type="text" name="from_name" id="from_name" value="{{ $organization->from_name }}">
           
        </div>

        <div class="form-group">
            <label > Encryption</label>
           <input class="form-control" placeholder="" type="text" name="encryption" id="nssf" value="{{ $organization->encryption }}">
           
        </div>

        <div class="form-group">
            <label > Username</label>
           <input class="form-control" placeholder="" type="text" name="username" id="username" value="{{ $organization->username }}">
       
       
        <div class="form-group">
            <label > Password</label>
           <input class="form-control" placeholder="" type="text" name="password" id="password" value="{{ $organization->password }}">
           
        </div>

        
        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">
                @if (is_array(Session::get('error')))
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif

        @if (Session::get('notice'))
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        







        
      </div>
      <div class="modal-footer">
        
        <div class="form-actions form-group">
        	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Update Details</button>
        </div>

    </fieldset>
</form>
      </div>
    </div>
  </div>
</div>




<!-- logo Modal -->
<div class="modal fade" id="logo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Organization Logo</h4>
      </div>
      <div class="modal-body">


      	
      	<form method="POST" action="{{{ URL::to('organizations/logo/'.$organization->id) }}}" accept-charset="UTF-8" enctype="multipart/form-data">
   
    <fieldset>
        <div class="form-group">
            <label > Upload Logo</label>
            <input type="file" name="photo">
        </div>
        
        

        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">
                @if (is_array(Session::get('error')))
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif

        @if (Session::get('notice'))
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        







        
      </div>
      <div class="modal-footer">
        
        <div class="form-actions form-group">
        	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Update Logo</button>
        </div>

    </fieldset>
</form>
      </div>
    </div>
  </div>
</div>











@stop