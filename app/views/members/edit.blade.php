@extends('layouts.member')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Member</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('members/update/'.$member->id) }}}" accept-charset="UTF-8" enctype="multipart/form-data">

            <div class="row">
            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Member Branch</label>
                        <select name="branch_id" class="form-control">
                            @if($member->branch != null)
                            <option value="{{ $member->branch->id }}">{{ $member->branch->name }}</option>
                            @endif
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}"> {{ $branch->name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Member Groups</label>

                        <select name="group_id" class="form-control">
                             @if($member->group != null)
                             <option value="{{ $member->group->id }}">{{ $member->group->name }}</option>
                             @endif
                            @foreach($groups as $group)
                            <option value="{{$group->id }}"> {{ $group->name }}</option>
                            @endforeach

                        </select>
                
                    </div>
                </fieldset>

            </div>


            <div class="col-lg-3">

                 <fieldset>
                    <div class="form-group">
                        <img src="{{ asset('public/uploads/photos/'.$member->photo)}}" width="50px">
                        <label for="username">Member Photo</label>
                        <input type="file" name="photo" id="photo" value="{{ $member->photo}}">
                    </div>


                     <div class="form-group">
                        <img src="{{ asset('public/uploads/photos/'.$member->signature)}}" width="50px">
                        <label for="username">Member Signature</label>
                        <input placeholder="" type="file" name="signature" id="signature" value="{{ $member->signature }}">
                    </div>
                </fieldset>

            </div>


            <div class="col-lg-4">

                 <fieldset>
                   

                    <div class="form-group">
                        <label for="username">Membership Number</label>
                        <input class="form-control" placeholder="" type="text" name="membership_no" id="membership_no" value="{{$member->membership_no}}" >
                    </div>


                </fieldset>

            </div>
</div>


<div class="row">


             <div class="col-lg-12"><hr></div></div>

<div class="row">


             <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Member Names</label>
                        <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$member->name}}" required>
                    </div>

                    <div class="form-group">
                        <label for="username">ID Number</label>
                        <input class="form-control" placeholder="" type="text" name="id_number" id="id_number" value="{{$member->id_number}}" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Gender</label><br>
                        @if($member->gender === 'male')
                        <input class=""  type="radio" name="gender" id="gender" value="male" checked> Male
                        <input class=""  type="radio" name="gender" id="gender" value="female"> Female
                        @endif

                         @if($member->gender === 'female')
                        <input class=""  type="radio" name="gender" id="gender" value="male" > Male
                        <input class=""  type="radio" name="gender" id="gender" value="female" checked> Female
                        @endif

                        @if($member->gender === '')
                        <input class=""  type="radio" name="gender" id="gender" value="male" > Male
                        <input class=""  type="radio" name="gender" id="gender" value="female"> Female
                        @endif
                    </div>





                </fieldset>


             </div>


             <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Phone Number</label>
                        <input class="form-control" placeholder="" type="text" name="phone" id="phone" value="{{ $member->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="username">Email Address</label>
                        <input class="form-control" placeholder="" type="text" name="email" id="email" value="{{ $member->email }}">
                    </div>

                     <div class="form-group">
                        <label for="username">Address</label>
                        <textarea class="form-control"  name="address" id="address">{{ $member->address }}</textarea>
                    </div>
                    </fieldset>


                     </div>


             <div class="col-lg-4">
                <fieldset>

                    

                    <div class="form-group">
                        <label for="username">Monthly Remmitance Amount</label>
                        <input class="form-control" placeholder="" type="text" name="monthly_remittance_amount" id="monthly_remittance_amount" value="{{ $member->monthly_remittance_amount }}">
                    </div>



                </fieldset>


             </div>
</div>






<div class="row">


             <div class="col-lg-4 pull-right">
   
                <fieldset>
        
      
        
                        <div class="form-actions form-group">
        
                            <button type="submit" class="btn btn-primary btn-sm">Update Member</button>
                        </div>

                </fieldset>
            </div>

        </div>
</form>
		

  </div>

</div>
























@stop