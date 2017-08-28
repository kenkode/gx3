@extends('layouts.teller')
@section('content')


									



<div class="row">
	
	<div class="col-lg-12">
		<hr>

	</div>
</div>


<div class="row">
	


	<div class="col-lg-12">


	<div class="panel panel-success">
      <div class="panel-heading">
          <h4>Members</h4>
        </div>
        <div class="panel-body">

		  <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Member Number</th>
        <th>Member Name</th>
        <th>Member Branch</th>

        <th></th>
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
          	 <a href="{{ URL::to('member/savingaccounts/'.$member->id) }}" class="btn btn-info btn-sm">Transact Savings</a>

                    </td>


                    

                     <td>
          	 <a href="{{ URL::to('sharetransactions/show/'.$member->shareaccount->id) }}" class="btn btn-info btn-sm">Transact Shares</a>

                    </td>
          


                     



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
</div>
</div>

	</div>	


<div class="row">

	<div class="col-lg-12">
		<hr>
	</div>	

	

	
</div>
@stop