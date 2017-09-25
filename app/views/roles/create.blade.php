@extends('layouts.system')
@section('content')



<div class="row">

	<div class="col-lg-5">

		<br/>

      <form method="POST" action="{{{ URL::to('roles') }}}" accept-charset="UTF-8">
        
   
    <fieldset>
        <div class="form-group">
            <label for="name">Role Name</label>
            <input class="form-control" placeholder="role name" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
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
</div>
<div class="row">

<div class="col-lg-12">
  <br>



        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <?php $i = 1; ?>
            @foreach($categories as $category)
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="{{$i}}">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Manage {{$category->category}}
        </a>
      </h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">

        <table class="table table-condensed">

          <tr>
<?php $count = 0; ?>
            @foreach($permissions as $perm)
              @if($perm->category == $category->category)


         

            <td>

              <input type="checkbox" name="permission[]" value="{{ $perm->id }}"> {{$perm->display_name}}


            </td>

         


          @endif

          <?php $i++; ?>
        @endforeach


          </tr>

        </table>
        

      </div>
    </div>
  </div>

  @endforeach


  
</div>



        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>
</div>










@stop