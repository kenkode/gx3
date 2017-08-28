@extends('layouts.organization')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Group</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('groups/update/'.$group->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Group Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$group->name}}">
        </div>


        <div class="form-group">
            <label for="username"> Description</label>
            <textarea class="form-control"  name="description" id="name">{{$group->description}} </textarea>
        </div>
        
        
        

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Group</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop