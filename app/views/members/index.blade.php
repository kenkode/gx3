@extends('layouts.member')
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

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('members/create')}}">new member</a>
        </div>
        <div class="panel-body">


  
      <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Member Number</th>
        <th>Member Name</th>
        <th>Member Branch</th>

        <th></th>
        

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($members as $member)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $member->membership_no }}</td>
          <td>{{ $member->name }}</td>
          <td>{{ $member->branch->name }}</td>
          <td>
             <a href="{{ URL::to('members/show/'.$member->id) }}" class="btn btn-info btn-sm">Manage</a>

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