@extends('layouts.system')
@section('content')




<div class="row">

	<div class="col-lg-12">

		<br/>

		<div class="panel panel-default">
			<div class="panel-heading">
    			<a class="btn btn-info btn-sm" href="{{ URL::to('users/create')}}">new user</a>
  			</div>
  			<div class="panel-body">

				<table id="users" class="display compact table table-bordered table-striped" cellspacing="0" width="100%">
					<thead>
						
						<th>Username</th>
						<th>Email</th>
						<th>created on</th>
						<th>confirmed</th>
						<th></th>
					</thead>
					<tbody>
              			 @foreach($users as $user)
              			 <tr>
               			
               			<td>{{ $user->username }}</td>
               			<td>{{ $user->email }}</td>
               			<td>{{ $user->created_at }}</td>
               			<?php if($user->confirmed){ ?>
               			<td> confirmed </td>
               			<?php } else { ?>
               			<td> not confirmed </td>
               			<?php } ?>
               			<td>

               				<div class="btn-group">
  								<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    								Action <span class="caret"></span>
  								</button>
  				
  								<ul class="dropdown-menu" role="menu">
    								<li><a href="{{URL::to('users/edit/'.$user->id)}}">Edit</a></li>

    								<?php if($user->confirmed){ ?>

                    <!--<li><a href="{{URL::to('tellers/create/'.$user->id)}}">Make Teller</a></li>-->
                    
    								<li><a href="{{URL::to('users/deactivate/'.$user->id)}}">Deactivate</a></li>


    								<?php } else { ?>
    								<li><a href="{{URL::to('users/activate/'.$user->id)}}">Activate</a></li>
    								<?php } ?>
    								<li><a href="{{URL::to('users/destroy/'.$user->id)}}">Delete</a></li>
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




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New User</h4>
      </div>
      <div class="modal-body">


      	
      	<form method="POST" action="{{{ URL::to('users/newuser') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
        </div>
        <div class="form-group">
            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
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
          <button type="submit" class="btn btn-primary btn-sm">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
        </div>

    </fieldset>
</form>
      </div>
    </div>
  </div>
</div>





@stop