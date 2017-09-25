@extends('layouts.membercss')
@section('content')

<div class="row">

  <?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

<div class="col-lg-12 ">

<br/>
<h3>shop</h3>
<hr>

</div>
</div>

<div class="row">

<div class="col-md-12">

 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif


		<br/>

		
<div class="row">


  @foreach($rproducts as $product)

  <form method="POST" action="{{{ URL::to('shopapplication') }}}" accept-charset="UTF-8">
  <div class="col-sm-3">
    <div class="thumbnail">


      <img src=" {{ asset('http://shop.lixnet.net/public/uploads/images/'.$product['image'])}}" width="100%"/>
      <div class="caption">
        
        <h3>{{$product['name']}}</h3>
        <p>{{$product['description']}}</p>
        

          <span class="label label-primary label-lg pull-right">KES {{ asMoney($product['price']) }}</span>
          <br><br>

        
            
      <select class="form-control" name="loanproduct" required>

          <option value=""> select loan product </option>
          <option value=""> ------------------ </option>
            @foreach($loans as $loan)
             
              <option value="{{ $loan->id }}"> {{ $loan->name }} </option>

                @endforeach
              
      </select>
<br>

            

            <input type="text" class="form-control" name="repayment" placeholder="repayment months" value=""/>

          
     
<br>

          
          <input type="hidden" name="amount" value="{{$product['price']}}"/>
          <input type="hidden" name="member" value="{{Confide::user()->username}}"/>
          <input type="hidden" name="purpose" value="{{$product['name']}}"/>
          <input type="hidden" name="product" value="{{$product['id']}}"/>

          <input type="submit" class="form-control btn btn-primary btn-xs" value="Get on Loan"/>
        
          <br>
      </div>
    </div>
  </div>
</form>

  @endforeach

@foreach($products as $product)

 <form method="POST" action="{{{ URL::to('shopapplication') }}}" accept-charset="UTF-8">
  <div class="col-sm-3">
    <div class="thumbnail">
      <img src=" {{ asset('public/uploads/images/'.$product->image)}}" width="100%"/>
      <div class="caption">
        <h3>{{$product->name}}</h3>
        <p>{{$product->description}}</p>
        

          <span class="label label-primary label-lg pull-right">KES {{ asMoney($product->price) }}</span>
          <br><br>

        
            
      <select class="form-control" name="loanproduct" required>

          <option value=""> select loan product </option>
          <option value=""> ------------------ </option>
            @foreach($loans as $loan)
             
              <option value="{{ $loan->id }}"> {{ $loan->name }} </option>

                @endforeach
              
      </select>
<br>

            

            <input type="text" class="form-control" name="repayment" placeholder="repayment months" value=""/>

          
     
<br>

          
          <input type="hidden" name="amount" value="{{$product->price}}"/>
          <input type="hidden" name="member" value="{{Confide::user()->username}}"/>
          <input type="hidden" name="purpose" value="{{$product->name}}"/>
          <input type="hidden" name="product" value="{{$product->id}}"/>

          <input type="submit" class="form-control btn btn-primary btn-xs" value="Get on Loan"/>
        
          <br>
      </div>
    </div>
  </div>
</form>
@endforeach 

</div>




</div>
</div>








      	
      	
     


@stop