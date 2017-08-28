@extends('layouts.charge')
@section('content')
<br/>

<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

<div class="row">
	<div class="col-lg-12">
  <h3>Charges</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('charges/create')}}">new Charge </a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        
        <th>name </th>
         <th>Category </th>
          <th>Calculation Method </th>
           <th>Payment Method </th>
          <th>percentage of </th>
          <th>Value </th>
       
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($charges as $charge)

        <tr>

       
          <td>{{ $charge->name }}</td>
           <td>{{ $charge->category }}</td>
           <td>{{ $charge->calculation_method }}</td>
            <td>{{ $charge->payment_method }}</td>
             <td>{{ $charge->percentage_of }}</td>
               <td>{{ $charge->amount }}</td>
          
     
         
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                   
                    <li><a href="{{URL::to('charges/edit/'.$charge->id)}}">Edit</a></li>
                    @if($charge->disabled)
                       <li><a href="{{URL::to('charges/enable/'.$charge->id)}}">Enable</a></li>
                    @endif

                     @if(!$charge->disabled)
                        <li><a href="{{URL::to('charges/disable/'.$charge->id)}}">Disable</a></li>
                    @endif
                 
                    <li><a href="{{URL::to('charges/delete/'.$charge->id)}}">Delete</a></li>
                    
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