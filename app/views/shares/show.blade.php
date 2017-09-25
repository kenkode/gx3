@extends('layouts.savings')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Share Management</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <tr>
        <td>Unit Value</td><td>{{ $share->value }}</td>
      </tr>
       <tr>
        <td>Transfer Charge</td><td>{{$share->transfer_charge}}</td>
      </tr>
      <tr>
        <td>Charged on </td><td>{{$share->charged_on}}</td>
      </tr>
      <tr>

        <td><a href="{{URL::to('shares/edit/'.$share->id)}}">Update</a></td>
      </tr>

    </table>
 


  </div>

</div>
























@stop