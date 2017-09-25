@extends('layouts.css')
@section('content')



<div class="row">

<div class="col-lg-12 ">



		<br/>

		<div class="panel panel-default">
			<div class="panel-heading">
    			<a  href="{{URL::to('vendors/create')}}" class="btn btn-success btn-sm" >New Vendor</a>
  			</div>
  			<div class="panel-body">

				<table class="table table-bordered table-hover" id="users">
					<thead>
						
						<th>Name </th>
						<th>Phone </th>

						<th>Email </th>
						<th>Description</th>
						
						
            <th>Status</th>
           <th></th>
					</thead>
					<tbody>
              			 @foreach($vendors as $vendor)
              			 <tr>
               			
               			<td>{{ $vendor->name  }}</td>
               			<td>{{ $vendor->phone }}</td>
               			<td>{{ $vendor->email }}</td>
               			<td>{{ $vendor->description }}</td>
               			<td>{{ $vendor->status }}</td>

                    
               			<td>

               				<div class="btn-group">
  								<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    								Action <span class="caret"></span>
  								</button>
  				
  								<ul class="dropdown-menu" role="menu">
    								
    								
    								<li><a href="{{URL::to('vendors/edit/'.$vendor->id)}}">Edit</a> </li>

    								
    								<li><a href="{{URL::to('vendors/delete/'.$vendor->id)}}"> Delete</a></li>
  								</ul>
							</div>

               			</td>
               		</tr>
               			
                  @endforeach
 
					</tbody>
				</table>
			</div>	
		</div>	
	</div>	





</div>









@stop