
{{HTML::script('media/jquery-1.8.0.min.js') }}
@extends('layouts.erp')

<script type="text/javascript">
$(document).ready(function() {
  
    $('#item').change(function(){
      
        $.get("{{ url('api/getpurchased')}}", 
        { option: $(this).val() }, 
        function(data) {
            /*console.log('hi');*/
                $('#sup').val(data);
            });
        });
   });
</script>

 {{ HTML::style('jquery-ui-1.11.4.custom/jquery-ui.css') }}
{ HTML::script('jquery-ui-1.11.4.custom/jquery-ui.js') }}

<script type="text/javascript">
$(document).ready(function(){
$('#').hide();

$('#item').change(function(){
if($(this).val()){
    $('#').show();
}else if($(this).val() == "EXPENSE"){
    $('#expensecategory').show();
    $('#assetcategory').hide();
    $('#liabilitycategory').hide();
    $('#incomecategory').hide();
    $('#assetcat').val('');
    $('#liabilitycat').val('');
    $('#incomecat').val('');
}else if($(this).val() == "LIABILITY"){
    $('#liabilitycategory').show();
    $('#assetcategory').hide();
    $('#expensecategory').hide();
    $('#incomecategory').hide();
    $('#assetcat').val('');
    $('#expensecat').val('');
    $('#incomecat').val('');
}else if($(this).val() == "INCOME"){
    $('#incomecategory').show();
    $('#assetcategory').hide();
    $('#expensecategory').hide();
    $('#liabilitycategory').hide();
    $('#assetcat').val('');
    $('#expensecat').val('');
    $('#liabilitycat').val('');
}else{
    $('#assetcategory').hide();
    $('#expensecategory').hide();
    $('#liabilitycategory').hide(); 
    $('#incomecategory').hide(); 
    $('#assetcat').val('');
    $('#expensecat').val('');
    $('#liabilitycat').val('');
    $('#incomecat').val('');
}

});
});
</script>




@section('content')

<br><div class="row">
    <div class="col-lg-12">
  <h3>Receive Stock</h3>

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

         <form method="POST" action="{{{ URL::to('stocks') }}}" accept-charset="UTF-8">
        <font color="red"><i>All fields marked with * are mandatory</i></font>

         <div class="form-group">
                        <label for="username">Date<span style="color:red">*</span> :</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{date('Y-m-d')}}" required>
                        </div>
          </div>

   
    <fieldset>
        <div class="form-group">
            <label for="username">Supplier <span style="color:red">*</span> :</label>
            <select name="item" class="form-control" id="item" required>
            <option> select Supplier ... </option>
                @foreach($clients as $client)
                @if($client->type == 'Supplier')
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endif
                @endforeach 
            </select>
        </div>


     <div class="form-group">
            <label for="username">Stock To receive <span style="color:red">*</span> :</label>
            <input type="text" name="order" id="sup" class="form-control" required>
        </div>

        <!--<div class="form-group" id="sup">
            <label for="username">Select Stock to recieve</label><span style="color:red">*</span> :
           <select name="order" id="sup" class="form-control" required>
                           <option></option>
                           <option>..................................Select Stock....................................</option>
                          
                            <option value=""></option>
                          
                        </select>
                </div>-->

        <div class="form-group">
            <label for="username">Store <span style="color:red">*</span> :</label>
            <select name="location" class="form-control" required>
            <option> select store ... </option>
                @foreach($locations as $location)
                <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
                
            </select>
        </div>

        <div class="form-group">
            <label for="username">Quantity <span style="color:red">*</span> :</label>
            <input type="text" name="quantity" id="quantity" class="form-control" required>
        </div>

        

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Receive/Generate Code</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop