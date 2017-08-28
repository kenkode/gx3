@extends('layouts.organization')
@section('content')
<br/><br/>

<div class="row">
	<div class="col-lg-12">

<button class="btn btn-info btn-xs " data-toggle="modal" data-target="#logo">update logo</button> 
&nbsp;&nbsp;&nbsp;
<button class="btn btn-info btn-xs " data-toggle="modal" data-target="#organization">update details</button>

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

			<td> Name</td><td>{{Organization::getOrganizationName()}}</td>

		</tr>

		<tr>

			<td> Email </td><td>{{$organization->email}}</td>

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
        <h4 class="modal-title" id="myModalLabel">Update Organization Details</h4>
      </div>
      <div class="modal-body">


      	
      	<form method="POST" action="{{{ URL::to('organizations/update/'.$organization->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label > Organization Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{ $organization->name }}">
        </div>
        
        <div class="form-group">
            <label > Organization Phone</label>
            <input class="form-control" placeholder="" type="text" name="phone" id="phone" value="{{ $organization->phone }}">
        </div>

        <div class="form-group">
            <label > Organization Email</label>
            <input class="form-control" placeholder="" type="text" name="email" id="email" value="{{ $organization->email }}">
        </div>

        <div class="form-group">
            <label > Organization Website</label>
            <input class="form-control" placeholder="" type="text" name="website" id="website" value="{{ $organization->website }}">
        </div>

        <div class="form-group">
            <label > Organization Address</label>
            <textarea class="form-control" name="address" id="address" >{{ $organization->address }}</textarea>
           
        </div>

        <div class="form-group">
            <label > Organization KRA Pin</label>
           <input class="form-control" placeholder="" type="text" name="pin" id="pin" value="{{ $organization->kra_pin }}">
           
        </div>

        <div class="form-group">
            <label > Organization Nssf Number</label>
           <input class="form-control" placeholder="" type="text" name="nssf" id="nssf" value="{{ $organization->nssf_no }}">
           
        </div>

        <div class="form-group">
            <label > Organization Nhif Number</label>
           <input class="form-control" placeholder="" type="text" name="nhif" id="nhif" value="{{ $organization->nhif_no }}">
           
        </div>

       
                    <div class="form-group">
                        <label>Bank</label>
                        <select name="bank_id" class="form-control">
                            <option></option>
                            @foreach($banks_db as $bank)
                            <option value="{{ $bank->id }}"<?= ($organization->bank_id==$bank->id)?'selected="selected"':''; ?>> {{ $bank->bank_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                      
                     <div class="form-group">
                        <label >Bank Branch</label>
                        <select name="bbranch_id" class="form-control">
                            <option></option>
                            @foreach($bbranches_db as $bbranch)
                            <option value="{{$bbranch->id }}"<?= ($organization->bank_branch_id==$bbranch->id)?'selected="selected"':''; ?>> {{ $bbranch->bank_branch_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

        <div class="form-group">
            <label > Bank Account Number</label>
           <input class="form-control" placeholder="" type="text" name="acc" id="acc" value="{{ $organization->bank_account_number }}">
           
        </div>

        <div class="form-group">
            <label > Swift Code</label>
           <input class="form-control" placeholder="" type="text" name="code" id="code" value="{{ $organization->swift_code }}">
           
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