@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Update Client</h4>

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

		 <form method="POST" action="{{{ URL::to('clients/update/'.$client->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Client Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$client->name}}" required>
        </div>

         <div class="form-group">
            <label for="username">Email:</label>
            <input class="form-control" placeholder="" type="email" name="email_office" id="email_office" value="{{$client->email}}">
        </div>

        <div class="form-group">
            <label for="username">Phone:</label>
            <input class="form-control" placeholder="" type="text" name="office_phone" id="office_phone" value="{{$client->phone}}">
        </div>

        <div class="form-group">
            <label for="username">Address:</label>
            <input class="form-control" placeholder="" type="text" name="address" id="address" value="{{$client->address}}">
        </div>

        <div class="form-group">
            <label for="username">Contact Name :</label>
            <input class="form-control" placeholder="" type="text" name="cname" id="cname" value="{{$client->contact_person}}">
        </div>
        
        <div class="form-group">
            <label for="username">Contact Personal Email:</label>
            <input class="form-control" placeholder="" type="email" name="email_personal" id="email_personal" value="{{$client->contact_person_email}}">
        </div>

        <div class="form-group">
            <label for="username">Contact Personal Contact:</label>
            <input class="form-control" placeholder="" type="text" name="mobile_phone" id="mobile_phone" value="{{$client->contact_person_phone}}">
        </div>

        <!-- <div class="form-group">
        	<label for="username">Type</label><span style="color:red">*</span> :
           <select name="type" class="form-control" required>
                           <option></option>
                            <option value="Customer"<?= ($client->type=='Customer')?'selected="selected"':''; ?>>Customer</option>
                            <option value="Supplier"<?= ($client->type=='Supplier')?'selected="selected"':''; ?>>Supplier</option>
                        </select>
        </div> -->

        <div class="radio">
          <label>
           @if($client->type == 'Customer')
              <input type="radio" name="type" id="customer" value="Customer" checked >
                    Customer   

             @else

            <input type="radio" name="type" id="customer" value="Customer">
                    Customer

             @endif 
              </label>
              <br>
              <p>              
            
        </div>

        <div class="radio">
          <label>
          @if($client->type == 'Supplier')
              <input type="radio" name="type" id="supplier" value="Supplier" checked>
                    Supplier

          @else

          <input type="radio" name="type" id="supplier" value="Supplier">
                    Supplier
              
           @endif 
              </label>
              <br>
              <p>              

        </div>

        <div class="form-group">
            <label>Category</label><span style="color:red;">*</span>
            <select name="category" class="form-control" required>
                <option value="">----Select a category----</option>
                <option value="Institutional" <?= ($client->category==='Institutional')?'selected="selected"':''; ?> >Institutional</option>
                <option value="Domestic" <?= ($client->category==='Domestic')?'selected="selected"':''; ?> >Domestic</option>
            </select>
        </div>


        <!-- <div class="form-group" id="percentage_discount">
        <div class="form-group">
            <label for="username">Percentage Discount(e.g. 5):</label>
            <input class="form-control" placeholder="" type="text" name="percentage_discount" id="percentage_discount" value="{{$client->percentage_discount}}">
        </div>
        </div> -->

        <div class="form-group">
            <label for="username">Balance Brought Forward :</label>
            <input class="form-control" placeholder="" type="text" name="balance" id="balance" value="{{$client->balance}}">
        </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Client</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop