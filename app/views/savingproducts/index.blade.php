@extends('layouts.savings')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Saving Products</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('savingproducts/create')}}">new Saving product</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Product Name</th>
        <th>Short name</th>
        <th>Opening Balance</th>
        <th>Currency</th>
         
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($savingproducts as $product)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->shortname }}</td>
          <td>{{ $product->opening_balance }}</td>
          <th>{{$product->currency}}</th>

           
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('savingproducts/show/'.$product->id)}}">View</a></li>
                    <li><a href="#">Update</a></li>
                   
                    <li><a href="#">Delete</a></li>
                    
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>
























@stop