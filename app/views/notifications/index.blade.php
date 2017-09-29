@extends('layouts.system')
@section('content')
<br/><br/>

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-12">

	 @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

    @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif

    @if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif

<p>Notification Panel</p>
<hr>

<br>
</div>	


<div class="col-lg-12 ">
<div class="panel-heading">
          <a class="btn btn-success btn-sm" href="{{ URL::to('notifications/markallasread')}}">Mark All As Read</a>
        </div>
	
<table id="users" class="table table-condensed table-bordered table-responsive table-hover">

    <thead>
            <th>#</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
    </thead>

    <tbody>
        <?php $i=1; ?>
        @foreach($notifications as $notification)
        @if($notification->is_read == 0)
        <tr>
            <td><strong>{{$i}}</strong></td>
            <td><strong>{{$notification->message}}</strong></td>
            <td><strong>{{date('d-M-Y', strtotime($notification->created_at))}}</strong></td>
            <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    @if($notification->type == 'item')
                    <li><a href="{{URL::to($notification->link)}}">Approve Item Update</a></li>
                    @elseif($notification->type == 'price')
                    <li><a href="{{URL::to($notification->link)}}">Approve Price Update</a></li>
                    @elseif($notification->type == 'stock')
                    <li><a href="{{URL::to($notification->link)}}">Approve Stock</a></li>
                    @elseif($notification->type == 'review purchase order')
                    <li><a href="{{URL::to($notification->link)}}">Review Purchase Order</a></li>
                    @elseif($notification->type == 'authorize purchase order')
                    <li><a href="{{URL::to($notification->link)}}">Authorize Purchase Order</a></li>
                    @endif
                    <li><a href="{{URL::to('notifications/markasread/'.$notification->id)}}">Mark As Read</a></li>
                  </ul>
              </div>

                    </td>
        </tr>
        @else
        <tr>
            <td>{{$i}}</td>
            <td>{{$notification->message}}</td>
            <td>{{date('d-M-Y', strtotime($notification->created_at))}}</td>
            <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    @if($notification->type == 'item')
                    <li><a href="{{URL::to($notification->link)}}">Approve Item Update</a></li>
                    @elseif($notification->type == 'price')
                    <li><a href="{{URL::to($notification->link)}}">Approve Price Update</a></li>
                    @elseif($notification->type == 'stock')
                    <li><a href="{{URL::to($notification->link)}}">Approve Stock</a></li>
                    @elseif($notification->type == 'review purchase order')
                    <li><a href="{{URL::to($notification->link)}}">Review Purchase Order</a></li>
                    @elseif($notification->type == 'authorize purchase order')
                    <li><a href="{{URL::to($notification->link)}}">Authorize Purchase Order</a></li>
                    @endif
                  </ul>
              </div>

                    </td>
        </tr>
        @endif

        <?php $i++;?>
        @endforeach

    </tbody>

</table>

</div>	



</div>


@stop