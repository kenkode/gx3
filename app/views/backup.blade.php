@extends('layouts.system')
@section('content')
<br/><br/>

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-12">

	@if (Session::get('error'))
            <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
        @endif

<a href="{{URL::to('backups/create')}}" class="btn btn-info"> Create Backup</a>
<hr>

<br>
</div>	


<div class="col-lg-12 ">

	<table class="table table-bordered table-responsive table-hover" id="users">

    <thead>
            <th>Database dump</th>
            <th></th>
            
    </thead>

    <tbody>
    
            <tr>
                <td></td>
                <td><a href="{{URL::to('restore/')}}" class="btn btn-default">Restore</a></td>
            

            </tr>
        

    </tbody>

</table>


</div>	



</div>


@stop