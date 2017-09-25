@extends('layouts.css')
@section('content')



<div class="row">

<div class="col-lg-12 ">



		<br/>

		<div class="panel panel-default">
			<div class="panel-heading">
    			Orders
  			</div>
  			<div class="panel-body">

				<table class="table table-bordered table-hover" id="users">
					<thead>
						
						<th>Member Name </th>
						<th>Member # </th>

						<th>Product </th>
						<th>Supplier</th>
						
						
            <th>Status</th>
           <th></th>
					</thead>
					<tbody>
              			 @foreach($orders as $order)
              			 <tr>
               			
               			<td>{{ $order->customer_name  }}</td>
               			<td>{{ $order->customer_number  }}</td>
               			<td>{{ $order->product->name  }}</td>
               			<td>{{ $order->product->vendor->name  }}</td>
               			<td>{{ $order->status }}</td>

                    
               			<td>

               				<div class="btn-group">
  								<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    								Action <span class="caret"></span>
  								</button>
  				
  								<ul class="dropdown-menu" role="menu">
    								
    								
    								

    								
    								<li><a href="#"> Delivered</a></li>
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