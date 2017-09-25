@extends('layouts.accounting')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h3>Chart of Accounts</h3>

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


       

		 <form method="POST" action="{{{ URL::to('accounts') }}}" accept-charset="UTF-8">
   
    <fieldset>

         <div class="form-group">
            <label for="username">Account Category</label>
            <select class="form-control" name="category">
                <option value="">select category</option>
                <option>--------------------------</option>
                <option value="ASSET">Asset (1000)</option>
                <option value="INCOME">Income (2000)</option>
                <option value="EXPENSE">Expense (3000)</option>
                <option value="EQUITY">Equity (4000)</option>
                <option value="LIABILITY">Liability (5000)</option>
            </select>
            
        </div>



        <div class="form-group">
            <label for="username">Account Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>


        <div class="form-group">
            <label for="username">GL Code</label>
            <input class="form-control" placeholder="" type="text" name="code" id="code" value="{{{ Input::old('code') }}}">
        </div>

        <div class="form-group">
                <label for = "username">Balance</label> 
                
                    <div class="input-group">
                        <span class="input-group-addon">KES</span>
                        <input type="text" class="form-control"  id="balance" name="balance" value="{{{ Input::old('balance') }}}">
                    
                         </div>                                                                          
                </div>
        

        <div class="form-group">
            <label for="username">Active</label>&nbsp;&nbsp;
            <input   type="checkbox" name="active" id="active" value="1">
        </div>
        
        

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Account</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop