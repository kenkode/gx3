@include('includes.head')

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                      
                    <div class="panel-body">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ HTML::image("images/logo.png", "Logo") }}
               
                        

                        @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
          

          <form role="form" method="POST" action="{{{ URL::to('/license/activate') }}}" accept-charset="UTF-8">

    
        
        <input class="form-control" tabindex="1"  type="hidden" name="org_id" id="org_id" value="{{ $organization->id}}" >
    <fieldset>

        <div class="form-group">
            <label for="email"> <i class="fa fa-home"></i> Organization</label>
            
            <input class="form-control" tabindex="1"  type="text" name="org_name" id="org_name" value="{{ $organization->name}}" readonly>
        </div>

        <div class="form-group">
            <label for="email">  <i class="fa fa-tags"></i> License Code</label>
           
            <input class="form-control" tabindex="1"  type="text" name="license_code" id="license_code" value="{{ $organization->license_code}}" readonly>
        </div>
        <div class="form-group">
        <label for="password">
            <i class="fa fa-sign-in"></i>
          License Key
        </label>
        
        <input class="form-control" tabindex="2"  type="text" name="license_key" id="license_key">
        
        </div>

        <div class="form-actions">
            
                <button tabindex="3" type="submit" class="btn btn-danger">Activate System</button>
            </div>




       
       
        
    </fieldset>
</form>




                    </div>
                </div>
            </div>
        </div>
    </div>