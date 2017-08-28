@extends('layouts.ports')
@section('content')
<br/>





<div class="row">
	<div class="col-lg-12">
  <h3> Member Reports</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <ul>

      <li>

        <a href="{{ URL::to('reports/listing') }}" target="_blank"> Members Listing report</a>

      </li>


       <li>

        <a href="reports/remittance" target="_blank"> Members monthly Remittance Schedule report</a>

      </li>


      <li>

        <a href="reports/blank" target="_blank">Blank report template</a>

      </li>


      <li>

        <a href="reports/combined" target="_blank">Combined Member Statement</a>

      </li>



    </ul>

  </div>

</div>
























@stop