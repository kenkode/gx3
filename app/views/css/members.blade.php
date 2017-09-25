@extends('layouts.css')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Members</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    @if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif

    <div class="panel panel-default">
      <div class="panel-heading">
          <p>Active Members</p>
        </div>
        <div class="panel-body">


  
      <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Member Number</th>
        <th>Member Name</th>
      

        <th></th>
        

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($members as $member)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $member->membership_no }}</td>
          <td>{{ $member->name }}</td>
     
           <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    @if($member->is_css_active == false)
                    <li><a href="{{URL::to('portal/activate/'.$member->id)}}">Activate</a></li>
                   @endif

                    @if($member->is_css_active == true)

                    <li><a href="{{URL::to('portal/deactivate/'.$member->id)}}">Deactivate</a></li>

                    @endif

                    <li><a href="{{URL::to('css/reset/'.$member->id)}}">Reset Password</a></li>
                    
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