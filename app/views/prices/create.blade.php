{{HTML::script('media/jquery-1.8.0.min.js') }}
@extends('layouts.erp')
<script type="text/javascript">
$(document).ready(function() {
  
    $('#item').change(function(){
      
        $.get("{{ url('api/getsellingprice')}}", 
        { option: $(this).val() }, 
        function(data) {
            /*console.log('hi');*/
                $('#selling_price').val(data);
            });
        });
   });
</script>
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>New Pricing</h4>

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

		 <form method="POST" action="{{{ URL::to('prices') }}}" accept-charset="UTF-8">
   
    <fieldset>
         <div class="form-group">
            <label for="username">Client Name <span style="color:red">*</span> :</label>
            <select name="client" id="client" class="form-control" required>                
                <option>       ......................... select Client........................</option>
                @foreach($clients as $client)
                @if($client->type == 'Customer')                    
                    <option value="{{$client->id}}">{{$client->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>

         <div class="form-group ">
            <label>Item</label><span style="color:red">*</span> :
            <select name="item" id="item" class="form-control" required>                       
            <option>       ......................... select item........................</option>
                @foreach($items as $item)
                
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    
                @endforeach
            </select>
        </div>

        
        <div class="form-group">
            <label for="username">Selling Price:</label>
            <input class="form-control" placeholder="" type="text" name="selling_price" id="selling_price" value="" readonly>
        </div>

        <div class="form-group">
            <label for="username">Discount:</label>
            <input class="form-control" placeholder="" type="text" name="discount" id="discount" value="{{{ Input::old('discount') }}}">
        </div>

        <!-- <div class="form-group">
            <label for="username">Customer Price:</label>
            <input class="form-control" placeholder="" type="text" name="customer_price" id="customer_price" value="">
        </div> -->

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Set Discount</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop