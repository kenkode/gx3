@extends('layouts.erp')
@section('content')
<br><br/>

@if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif

<div class="row">
                      <div class="col-md-2">
                        <a href="{{ URL::to('items/create')}}"><img border="0" src="{{asset('images/Add-icon.png')}}" alt="New Item" width="75">
                          
                          <div>New Item</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a href="{{ URL::to('clients/create')}}"><img border="0" src="{{asset('images/addclients.png')}}" alt="New Client" width="75">
                         
                          <div>New Client</div>
                          
                        </a>
                      </div>


                      <div class="col-md-2">
                        <a href="{{URL::to('salesorders/create')}}"><img border="0" src="{{asset('images/addsale.jpg')}}" alt="New Sale" width="75">
                        
                                <div>New Sale</div>
                         
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a  href="{{ URL::to('purchaseorders/create')}}"><img border="0" src="{{asset('images/cart-add-icon.png')}}" alt="New Purchase" width="75">
                          
                          <div>New Purchase</div>
                          
                        </a>
                      </div>
                      
                      <div class="col-md-2">
                        <a href="{{ URL::to('payments/create')}}"><img border="0" src="{{asset('images/payments.png')}}" alt="New Payment" width="75">
                          
                          <div>New Payment</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a href="{{ URL::to('stocks/create')}}"><img border="0" src="{{asset('images/receivestock.jpg')}}" alt="New Payment" width="75">
                          
                          <div>Receive Stock</div>
                          
                        </a>
                      </div>


                       

                      
                    </div>


<br><br>


<hr>
<div class="row">
                          
<div class="col-lg-2"></div>
  <div class="col-lg-2">

    

    <br><br>
    <img src="{{asset('images/ourlogo.png')}}">
    
  </div>


</div>

@stop