@extends('layouts.system')
@section('content')



<div class="row">

	<div class="col-lg-5">

		<br/>

      <form method="POST" action="{{{ URL::to('users/newuser') }}}" accept-charset="UTF-8">
        <input class="form-control" type="hidden" name="user_type" id="user_type" value="admin">
         <input class="form-control" type="hidden" name="organization_id" id="user_type" value="1">
   
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


        <div class="form-group">
            <label>Assign Roles</label>
            <table class="table table-condensed">

          <tr>

            @foreach($roles as $role)
       


         

            <td>

              <input type="checkbox" name="role[]" value="{{ $role->id }}"> {{$role->name}}


            </td>

         


       
        @endforeach


          </tr>

        </table>
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

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create User</button>
        </div>

    </fieldset>
</form>
		

  </div>
</div>










@stop