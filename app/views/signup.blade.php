@include('includes.head')

<div class="container">

<div class="row">

	<div class="col-lg-5 col-md-offset-3">

         <div class="login-panel panel panel-default">
                      
                    <div class="panel-body">


                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ HTML::image("images/logo.png", "Logo") }}

		<br/><br>

      <form method="POST" action="{{{ URL::to('users') }}}" accept-charset="UTF-8">

        <input class="form-control" type="hidden" name="user_type" id="user_type" value="admin">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Organization</label>
            <input class="form-control" placeholder="organization name" type="text" name="organization" id="organization" value="{{{ Input::old('organization') }}}" required>
        </div>

        <hr>
        <div class="form-group">
            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}" required>
        </div>
        <div class="form-group">
            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} </small></label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="email" name="email" id="email" value="{{{ Input::old('email') }}}" required>
        </div>
        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation" required>
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
        
          <button type="submit" class="btn btn-primary btn-sm">Create Account</button>
        </div>

    </fieldset>
</form>
		

        </div>
    </div>

  </div>
</div>

</div>










