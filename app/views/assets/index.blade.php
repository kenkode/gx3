<?php
	function asMoney($value){
		return number_format($value, 2);
	}
?>

@extends('layouts.accounting')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h4><font color="green">Fixed Assets</font></h4>
		<hr>
	</div>
</div>

<div class="row">	
	<!-- QUICK LINK BUTTONS -->
	<div class="col-lg-12">
		<a href="{{ URL::to('assetManagement/create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus fa-fw"></i> New Asset</a>&emsp;
		<!-- <a href="" class="btn btn-warning btn-sm"> Run Depreciation</a>&emsp; -->
		<hr>
	</div><!-- ./END -->

	<!-- FIXED ASSETS BODY SECTION -->
	<div class="col-lg-12">
		<!-- TAB LINKS -->
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#registeredAssets">Registered ({{ Asset::where('status', 'new')->count() }})</a></li>
			<li><a data-toggle="tab" href="#soldDisposedAssets">Sold & Disposed ({{ Asset::where('status', '<>', 'new')->count() }})</a></li>
		</ul>

		<!-- TAB CONTENT -->
		<div class="tab-content">
			<!-- REGISTERED ASSETS -->
			<div id="registeredAssets" class="tab-pane fade in active">
				<table class="table table-condensed table-bordered table-responsive table-hover users">
					<thead>
						<tr>
							<th>#</th>
							<th>Asset Name</th>
							<th>Asset Number</th>
							<th>Purchase Date</th>
							<th>Purchase Price</th>
							<th>Last Depreciated</th>
							<th>Book Value</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $count=1; ?>
						@if(count($assets) > 0)
						@foreach($assets as $asset)
						@if($asset->status == 'new')

						<tr>
							<td>{{ $count }}</td>
							<td>{{ $asset->asset_name }}</td>
							<td>{{ $asset->asset_number }}</td>
							<td>{{ date('jS M, Y', strtotime($asset->purchase_date)) }}</td>
							<td>{{ asMoney($asset->purchase_price) }}</td>
							
							@if($asset->last_depreciated == '0000-00-00')
								<td>Never</td>
							@else
								<td>{{ date('jS M, Y', strtotime($asset->last_depreciated)) }}</td>
							@endif

							<td>{{ asMoney($asset->book_value) }}</td>
							<td>
								<div class="btn-group pull-right"> 
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Action <i class="fa fa-caret-down fa-fw"></i>
									</button>
									<ul class="dropdown-menu" role="menu"> 
										<li><a href="{{ URL::to('assetManagement/'.$asset->id) }}">View</a></li>
										<li><a href="{{ URL::to('assetManagement/'.$asset->id.'/edit') }}">Edit</a></li>
										<li><a href="{{ URL::to('assetManagement/dispose/'.$asset->id) }}">Dispose</a></li>
										<li><a href="{{ URL::to('assetManagement/delete/'.$asset->id) }}" onclick="return (confirm('Are you sure you want to delete this item?'))">Delete</a></li>
									</ul>
								</div>
							</td>
						</tr>
						<?php $count++; ?>
						
						@endif
						@endforeach
						@endif

					</tbody>
				</table>
			</div><!-- ./End of registered assets -->
			
			<!-- SOLD/DISPOSED ASSETS -->
			<div id="soldDisposedAssets" class="tab-pane fade in">
				<!-- SOLD/DISPOSED ASSETS -->
				<table class="table table-condensed table-bordered table-responsive table-hover users">
					<thead>
						<tr>
							<th>#</th>
							<th>Asset Name</th>
							<th>Asset Number</th>
							<th>Purchase Date</th>
							<th>Purchase Price</th>
							<th>Status</th>
							<th>Book Value</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $count=1; ?>
						@if(count($assets) > 0)
						@foreach($assets as $asset)
						@if($asset->status != 'new')

						<tr>
							<td>{{ $count }}</td>
							<td>{{ $asset->asset_name }}</td>
							<td>{{ $asset->asset_number }}</td>
							<td>{{ date('jS M, Y', strtotime($asset->purchase_date)) }}</td>
							<td>{{ asMoney($asset->purchase_price) }}</td>
							<td>{{ $asset->status }}</td>
							<td>{{ asMoney($asset->book_value) }}</td>
							<td>
								<div class="btn-group pull-right"> 
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Action <i class="fa fa-caret-down fa-fw"></i>
									</button>
									<ul class="dropdown-menu" role="menu"> 
										<li><a href="{{ URL::to('assetManagement/'.$asset->id) }}">View</a></li>
										<li><a href="{{ URL::to('assetManagement/'.$asset->id.'/edit') }}">Edit</a></li>
										<li><a href="{{ URL::to('assetManagement/dispose/'.$asset->id) }}">Dispose</a></li>
										<li><a href="{{ URL::to('assetManagement/delete/'.$asset->id) }}" onclick="return (confirm('Are you sure you want to delete this item?'))">Delete</a></li>
									</ul>
								</div>
							</td>
						</tr>
						<?php $count++; ?>
	
						@endif
						@endforeach
						@endif

					</tbody>
				</table>
			</div><!-- ./End of disposed assets -->
		</div><!-- ./End of tab cotent -->

	</div><!-- ./End of body section -->

</div>

@stop