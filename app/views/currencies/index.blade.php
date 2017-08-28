@extends('layouts.organization')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Currencies</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('currencies/create')}}">New Currency</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Currency Name</th>
        <th>Currency Code</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($currencies as $currency)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $currency->name }}</td>
          <td>{{ $currency->shortname }}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('currencies/edit/'.$currency->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('currencies/delete/'.$currency->id)}}">Delete</a></li>
                    
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>
























@stop