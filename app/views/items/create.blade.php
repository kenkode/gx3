@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Item</h3>

<hr>
</div>	
</div>
<font color="red"><i>All fields marked with * are mandatory</i></font>

<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('items') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Item Make <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="item_make" id="item_make" value="{{{ Input::old('item_make') }}}" required>
        </div>
        <div class="form-group">
            <label for="username">Item Size <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="item_size" id="item_size" value="{{{ Input::old('item_size') }}}" required>
        </div>

         <div class="form-group">
            <label for="username">Description:</label>
            <textarea rows="5" class="form-control" name="description" id="description" >{{ Input::old('email_office') }}</textarea>
        </div>

        <div class="form-group">
            <label for="username">Purchase Price <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="pprice" id="pprice" value="{{{ Input::old('pprice') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Selling price <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="sprice" id="sprice" value="{{{ Input::old('sprice') }}}" required>
        </div>

        <div class="form-group">
            <label for="username">Store Keeping Unit:</label>
            <input class="form-control" placeholder="" type="text" name="sku" id="sku" value="{{{ Input::old('sku') }}}">
        </div>

        <div class="form-group">
            <label for="username">Tag Id:</label>
            <input class="form-control" placeholder="" type="text" name="tag" id="tag" value="{{{ Input::old('tag') }}}">
        </div>
        
        <div class="form-group">
            <label for="username">Reorder Level:</label>
            <input class="form-control" placeholder="" type="text" name="reorder" id="reorder" value="{{{ Input::old('reorder') }}}">
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Item</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop