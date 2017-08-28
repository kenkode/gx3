<?php
function asMoney($value) {
  return number_format($value, 2);
}
?>

@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>New Client</h4>

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

		 <form method="POST" action="{{{ URL::to('clients') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Client Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}" required>
        </div>

         <div class="form-group">
            <label for="username">Email:</label>
            <input class="form-control" placeholder="" type="email" name="email_office" id="email_office" value="{{{Input::old('email_office') }}}" >
        </div>

        <div class="form-group">
            <label for="username">Phone:</label>
            <input class="form-control" placeholder="" type="text" name="office_phone" id="office_phone" value="{{{ Input::old('office_phone') }}}">
        </div>

        <div class="form-group">
            <label for="username">Address:</label>
            <input class="form-control" placeholder="" type="text" name="address" id="address" value="{{{ Input::old('email_personal') }}}">
        </div>

        <div class="form-group">
            <label for="username">Contact Name :</label>
            <input class="form-control" placeholder="" type="text" name="cname" id="cname" value="{{{ Input::old('cname') }}}">
        </div>
        
        <div class="form-group">
            <label for="username">Contact Personal Email:</label>
            <input class="form-control" placeholder="" type="email" name="email_personal" id="email_personal" value="{{{ Input::old('email_personal') }}}">
        </div>

        <div class="form-group">
            <label for="username">Personal Mobile:</label><span style="color:red">*</span>
            <input class="form-control" placeholder="" type="text" name="mobile_phone" id="mobile_phone" value="{{{ Input::old('address') }}}" required>
        </div>

        <!-- <div class="form-group">
        	<label for="username">Type</label><span style="color:red">*</span> :
           <select name="type" class="form-control" required>
                           <option></option>
                            <option value="Customer"> Customer</option>
                            <option value="Supplier"> Supplier</option>
                        </select>
        </div> -->

        <div class="radio">
          <label>
              <input type="radio" name="type" id="customer" value="Customer">
                    Customer
              </label>
              <br>
              <p>              

        </div>

        <div class="radio">
          <label>
              <input type="radio" name="type" id="supplier" value="Supplier">
                    Supplier
              </label>
              <br>
              <p>              

        </div>
        
        <div class="form-group">
            <label>Category</label><span style="color:red;">*</span>
            <select name="category" class="form-control" required>
                <option value="">----Select a category----</option>
                <option value="Institutional">Institutional</option>
                <option value="Domestic">Domestic</option>
            </select>
        </div>

         <script type="text/javascript">
            $(document).ready(function(){
            /*$("#purchase_price").hide();*/            
            $('#customer').click(function(){

            if($('#customer').is(":checked")){
            $('#customer:checked').each(function(){
            
            $("#percentage_discount").show();                       

            });
            }else{

              $("#percentage_discount").hide();
             
            }
            });



                        
            $('#supplier').click(function(){
            $("#percentage_discount").hide();
            if($('#supplier').is(":checked")){
            $('#supplier:checked').each(function(){
            $("#percentage_discount").hide();
                          

            });
            }else{

              $("#percentage_discount").show();
            }
            });
            
            });
          </script>

        <!-- <div class="form-group" id="percentage_discount">
        <div class="form-group">
            <label for="username">Percentage Discount(e.g. 5):</label>
            <input class="form-control" placeholder="" type="text" name="percentage_discount" id="percentage_discount" value="{{{ Input::old('percentage_discount') }}}">
        </div>
        </div> -->
        <div class="form-group">
            <label for="username">Balance Brought Forward :</label>
            <div class="input-group">
                <span class="input-group-addon">KES</span>
                <input class="form-control" placeholder="{{ asMoney(0) }}" type="text" name="balance" id="balance" value="{{{ Input::old('balance') }}}">
            </div>
        </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Client</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop