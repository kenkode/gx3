@extends('layouts.erp')
@section('content')

<br><div class="row">
    <div class="col-lg-12">
  <h3>Update Item</h3>

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

         <form method="POST" action="{{{ URL::to('items/update/'.$item->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Item Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$item->item_make}}" required>
        </div>

        <div class="form-group">
            <label for="username">Item Size <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="item_size" id="item_size" value="{{$item->item_size}}" required>
        </div>

         <div class="form-group">
            <label for="username">Description:</label>
            <textarea rows="5" class="form-control" name="description" id="description" >{{$item->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="username">Purchase Price <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="pprice" id="pprice" value="{{$item->purchase_price}}" required>
        </div>

        <div class="form-group">
            <label for="username">Selling price <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="sprice" id="sprice" value="{{$item->selling_price}}" required>
        </div>

        <div class="form-group">
            <label for="username">Store Keeping Unit:</label>
            <input class="form-control" placeholder="" type="text" name="sku" id="sku" value="{{$item->sku}}">
        </div>

        <div class="form-group">
            <label for="username">Tag Id:</label>
            <input class="form-control" placeholder="" type="text" name="tag" id="tag" value="{{$item->tag_id}}">
        </div>
        
        <div class="form-group">
            <label for="username">Reorder Level:</label>
            <input class="form-control" placeholder="" type="text" name="reorder" id="reorder" value="{{$item->reorder_level}}">
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Item</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop