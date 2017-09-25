@extends('layouts.ports')
@section('content')
<br/>





<div class="row">
	<div class="col-lg-12">
  <h3> Savings Reports</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <ul>

      <li>

        <a href="{{ URL::to('reports/savinglisting') }}" target="_blank"> Savings Listing report</a>

      </li>

      @foreach($savingproducts as $savingproduct)

       <li>

        <a href="{{ URL::to('reports/savingproduct/'.$savingproduct->id)}}" target="_blank"> {{ $savingproduct->name}} report</a>

      </li>
      @endforeach


      



    </ul>

  </div>

</div>
























@stop