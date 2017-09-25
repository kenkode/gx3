@extends('layouts.system')
@section('content')
<br/><br/>

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-12">

	@if (Session::get('error'))
            <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if (Session::get('notice'))
            <div class="alert alert-info">{{{ Session::get('notice') }}}</div>
        @endif

<p>Bulk Process Savings</p>
<hr>

<br>
</div>	


<div class="col-lg-5 ">

	
<form method="POST" action="{{{ URL::to('automated') }}}"  enctype="multipart/form-data">
 


		<input type="hidden" value="savings" name="category">

        


        <div class="form-group savingproduct" id="savingproduct">
            <label for="username">Saving Products </label>
            <select name="savingproduct" class="form-control " >

                <?php $date = date('Y-m-d'); $category = 'saving'; ?>

                @foreach($savingproducts as $savingproduct)
                 @if(!Autoprocess::checkProcessed($date, $category, $savingproduct))
                <option value="{{$savingproduct->id}}">{{$savingproduct->name}}</option>
                @endif
                @endforeach
                

            </select>
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Process Savings</button>
        </div>


</form>	

</div>	



</div>






@stop