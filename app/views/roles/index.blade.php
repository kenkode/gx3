@extends('layouts.system')
@section('content')




<div class="row">

	<div class="col-lg-12">

		<br/>

		<div class="panel panel-default">
			<div class="panel-heading">
    			<a class="btn btn-info btn-sm" href="{{ URL::to('roles/create')}}">new role</a>
  			</div>
  			<div class="panel-body">

				<table id="users" class="display compact table table-bordered table-striped" cellspacing="0" width="100%">
					<thead>
						
						
						<th>Role</th>
						<th></th>
						
					</thead>
					<tbody>
              			 @foreach($roles as $role)
              			 <tr>
               			
               			<td>{{ $role->name }}</td>
               			
               			<td>

               				<div class="btn-group">
  								<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    								Action <span class="caret"></span>
  								</button>
  				
  								<ul class="dropdown-menu" role="menu">
                    <li><a href="#">Permissions</a></li>
    								<li><a href="#">Edit</a></li>

    								
    								<li><a href="{{URL::to('roles/destroy/'.$role->id)}}">Delete</a></li>
  								</ul>
							</div>

               			</td>
               		</tr>
               			@endforeach

 
					</tbody>
				</table>
			</div>	
		</div>	
	</div>	



</div>









@stop