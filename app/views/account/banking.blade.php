@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Money Transfer</h3>

<hr>
</div>	
</div>
<font color="red"><i>All fields marked with * are mandatory</i></font><br>
<div class="row">

	<div class="col-lg-5">
		
		

		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif



		<form class="form-group" method="post" action="{{ URL::to('account/bank/')}}">


			<div class="form-group">
				<label for="username">Source Account : <span style="color:red">*</span> </label>
					

						
						<select name="account_from" id="account_from" class=" form-control">

							<option>..........................Select Source  Account ..............</option>
							<option value="{{{ Input::old('account_from') }}}">{{{ Input::old('account_from') }}}</option>

							@foreach($banking as $account)
							<option value="{{$account->name}}">{{$account->name}}</option>
							@endforeach
						
						</select>
					
			</div>
		
		<div class="form-group">
				<label for="username">Destination Account : <span style="color:red">*</span> </label>
					
						
						<select name="account_to" id="status" class=" form-control">

							<option>..........................Select Destination Account ..............</option>
							<option value="{{{ Input::old('account_to') }}}">{{{ Input::old('account_to') }}}</option>

							@foreach($banking as $account)
							<option value="{{$account->name}}">{{$account->name}}</option>
							@endforeach
						
						</select>
					
			</div>

          

          <div class="form-group">
				<label for="username">Amount : <span style="color:red">*</span></label> 
				
					<div class="input-group">
						<span class="input-group-addon">KES</span>
						<input type="text" class="form-control"  name="amount" value="{{{ Input::old('amount') }}}">
					</div>																			
				
		</div>

      
        
			<div class="form-actions clearfix"> <input type="submit" value="Make Transaction" class="btn btn-primary"> </div>


		</form>



	</div>	

</div>


           
@stop