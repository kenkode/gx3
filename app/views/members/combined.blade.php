@extends('layouts.ports')
@section('content')
<br/>





<div class="row">
	<div class="col-lg-12">
  <h3> Combined Member Reports</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-8">

   <form method="post" action="{{URL::to('reports/combinedstatement')}}">


      <div class="form-group">
            <label for="username">Member</label>
            <select class="form-control" name="report_type">
                <option value="">select member</option>
                <option>-----------------------------------------</option>
                @foreach($members as $member)
                <option value="{{$member->id}}">{{$member->membership_no}}&nbsp;&nbsp; {{ ucwords($member->name)}}</option>
                @endforeach
                
                
            </select>
            
        </div>



        


        <div class="form-actions form-group">
        
        

          <button type="submit" class="btn btn-primary btn-sm">View Report</button> 
        </div>


   </form>

  </div>

</div>
























@stop