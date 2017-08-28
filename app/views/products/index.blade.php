@extends('layouts.css')
@section('content')



<div class="row">

<div class="col-lg-12 ">



		<br/>

		<div class="panel panel-default">
			<div class="panel-heading">
    			<a  href="{{URL::to('products/create')}}" class="btn btn-success btn-sm" >New Product</a>
  			</div>
  			<div class="panel-body">

				<table class="table table-bordered table-hover" id="users">
					<thead>
						
						<th>Image </th>
						<th>Vendor </th>

						<th>Name </th>
						<th>Description</th>
						
						<th>Price</th>
            			<th>Status</th>
                  <th></th>
           
					</thead>
					<tbody>
              			 @foreach($products as $product)
              			 <tr>
               			
               			<td><img src=" {{ asset('public/uploads/images/'.$product->image)}}" width="15%"/></td>
               			<td>{{ $product->vendor->name  }}</td>
               			<td>{{ $product->name }}</td>
               			<td>{{ $product->description }}</td>
               			<td>{{ $product->price }}</td>
               			<td>{{ $product->status }}</td>

                    
               			<td>

               				<div class="btn-group">
  								<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    								Action <span class="caret"></span>
  								</button>
  				
  								<ul class="dropdown-menu" role="menu">
    								
    								
    								<li><a href="{{URL::to('products/edit/'.$product->id)}}">Edit</a> </li>

    								
    								<li><a href="{{URL::to('products/delete/'.$product->id)}}"> Delete</a></li>
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