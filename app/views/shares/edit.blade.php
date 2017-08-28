@extends('layouts.savings')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Share Management</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-4">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{ URL::to('shares/update/'.$share->id) }}" accept-charset="UTF-8">
   
    <fieldset>
     
        
      

        <div class="form-group">
            <label for="username">Unit value</label>
            <input class="form-control" placeholder="" type="text" name="value" id="value" value="{{ $share->value }}" required>
        </div>


         <div class="form-group">
            <label for="username">Transfer Charge</label>
            <input class="form-control" placeholder="" type="text" name="transfer_charge" id="transfer_charge" value="{{ $share->transfer_charge }}" required>
        </div>


        
      

        


        <div class="form-group">
            <label for="username">Charged on</label>
            <select class="form-control" name="charged_on" required>
                <option value="{{$share->charged_on }}">{{$share->charged_on }}</option>

                <option>---------------------------</option>
               
                <option value="donor">Donor</option>
                 <option value="recepient">Recepient</option>

            </select>
        </div>
        

        
        
        



        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">update</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop