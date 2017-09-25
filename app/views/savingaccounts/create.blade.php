@extends('layouts.savings')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Saving Product</h3>

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

		 <form method="POST" action="{{ URL::to('savingaccounts') }}" accept-charset="UTF-8">
   
    <fieldset>
   

                <input type="hidden" name="member_id" value="{{ $member->id }}" />


        <div class="form-group">
            <label for="username">Saving Product</label>
            <select class="form-control" name="savingproduct_id" required>

                <option></option>
                @foreach($savingproducts as $product)
             
                <option value="{{ $product->id }}">{{ $product->name }}</option>
               
                @endforeach


            </select>
        </div>



        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Product</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop