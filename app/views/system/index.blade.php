@extends('layouts.system')
@section('content')
<br/><br/><br/><br/>
<br/><br/><br/><br/>

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-3">

{{ HTML::image("images/logo.png", "Logo") }}


</div>	


<div class="col-lg-5 ">

	<table class="table table-bordered table-condensed">

												  				<tr>

																	<td>System</td><td>XARAFinancials </td>
																</tr>
																<tr>

																	<td>Version</td><td>v3.3.10</td>
																</tr>

																<tr>

																	<td>Licensed To</td><td>{{Organization::getOrganizationName()}}</td>
																</tr>
																

																
																

															</table>



</div>	



</div>


@stop