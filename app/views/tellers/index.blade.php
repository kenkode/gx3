@extends('layouts.system')
@section('content')




<div class="row">

	<div class="col-lg-12">

		<br/>

		<div class="panel panel-default">
			<div class="panel-heading">
    			<p>Tellers</p>
  			</div>
  			<div class="panel-body">

				<table id="users" class="display compact table table-bordered table-striped" cellspacing="0" width="100%">
					<thead>
						
						<th>Teller</th>
					
			
						<th>status</th>
						<th></th>
					</thead>
					<tbody>
              			 @foreach($tellers as $user)
              			 <tr>
               			
               			<td>{{ $user->username }}</td>
               			
               			
               			<?php if($user->is_active){ ?>
               			<td> activated </td>
               			<?php } else { ?>
               			<td> deactivated </td>
               			<?php } ?>
               			<td>

               				<div class="btn-group">
  								<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    								Action <span class="caret"></span>
  								</button>
  				
  								<ul class="dropdown-menu" role="menu">
    								

    								<?php if($user->is_active){ ?>
    								<li><a href="{{URL::to('tellers/deactivate/'.$user->id)}}">Deactivate</a></li>
    								<?php } else { ?>
    								<li><a href="{{URL::to('tellers/activate/'.$user->id)}}">Activate</a></li>
    								<?php } ?>
    								
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