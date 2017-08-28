@extends('layouts.ports')
@section('content')
<br/>





<div class="row">
    <div class="col-lg-12">
  <h3>HR Reports</h3>

<hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-12">

    <ul>

        <li>

        <a href="{{ URL::to('employee/select') }}" target="_blank"> Individual Employee report</a>

      </li>

      <li>

        <a href="{{ URL::to('reports/employeelist') }}" target="_blank"> Employee List report</a>

      </li>


      <li>

        <a href="reports/blank" target="_blank">Blank report template</a>

      </li>



    </ul>

  </div>

</div>

@stop