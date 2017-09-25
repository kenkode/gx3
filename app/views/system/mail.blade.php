@extends('layouts.system')
@section('content')


<div class="row">



<br><br>

<div class="col-lg-5 ">
Mail Configuration
<hr/>

 @if (Session::get('notice'))
            <div class="alert alert">{{ Session::get('notice') }}</div>
        @endif

 <form method="POST" action="{{{ URL::to('mails') }}}" accept-charset="UTF-8">

        <input class="form-control" type="hidden" name="user_type" id="user_type" value="admin">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Driver</label>
            <input class="form-control" type="text" name="driver" id="driver" value="{{$mail->driver}}" required readonly>
        </div>

        <div class="form-group">
            <label for="username">Host</label>
            <input class="form-control" type="text" name="host" id="host" value="{{$mail->host}}" required>
        </div>

        <div class="form-group">
            <label for="username">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="{{$mail->username}}" required>
        </div>

        <div class="form-group">
            <label for="username">Password</label>
            <input class="form-control" type="password" name="password" id="password" value="{{$mail->password}}" required>
        </div>

        <div class="form-group">
            <label for="username">Port</label>
            <input class="form-control" type="text" name="port" id="port" value="{{$mail->port}}" required>
        </div>

        <div class="form-group">
            <label for="username">Encryption</label>
            <input class="form-control" type="text" name="encryption" id="encryption" value="{{$mail->encryption}}" >
        </div>       
        

        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">
                @if (is_array(Session::get('error')))
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif       
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update</button>

          <a href="{{URL::to('mailtest')}}" class="btn btn-info btn-sm pull-right"> Test Connnection</a>
        </div>

    </fieldset>
</form>
	


</div>	



</div>


@stop