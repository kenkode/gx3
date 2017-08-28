@extends('layouts.member')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Member</h3>

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

		 <form method="POST" action="{{{ URL::to('members') }}}" accept-charset="UTF-8">

            <div class="row">
            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Member Branch</label>
                        <select name="branch_id" class="form-control">
                            <option></option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}"> {{ $branch->name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Member Groups</label>
                        <select name="group_id" class="form-control">
                            <option></option>
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
                        <label for="username">Member Photo</label>
                        <input  type="file" name="photo" id="name">
                    </div>


                     <div class="form-group">
                        <label for="username">Member Signature</label>
                        <input  type="file" name="signature" id="signature" >
                    </div>
                </fieldset>

            </div>


            <div class="col-lg-4">

                 <fieldset>
                   

                    <div class="form-group">
                        <label for="username">Membership Number</label>
                        <input class="form-control" placeholder="" type="text" name="membership_no" id="membership_no" value="{{{ Input::old('membership_no') }}}" >
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
                        <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">ID Number</label>
                        <input class="form-control" placeholder="" type="text" name="id_number" id="id_number" value="{{{ Input::old('id_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Gender</label><br>
                        <input class=""  type="radio" name="gender" id="gender" value="male"> Male
                        <input class=""  type="radio" name="gender" id="gender" value="female"> Female
                    </div>





                </fieldset>


             </div>


             <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Phone Number</label>
                        <input class="form-control" placeholder="" type="text" name="phone" id="phone" value="{{{ Input::old('phone') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Email Address</label>
                        <input class="form-control" placeholder="" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Address</label>
                        <textarea class="form-control"  name="address" id="address">{{{ Input::old('email') }}}</textarea>
                    </div>
                    </fieldset>


                     </div>


             <div class="col-lg-4">
                <fieldset>

                    

                    <div class="form-group">
                        <label for="username">Monthly Remmitance Amount</label>
                        <input class="form-control" placeholder="" type="text" name="monthly_remittance_amount" id="monthly_remittance_amount" value="{{{ Input::old('monthly_remittance_amount') }}}">
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="share_account">
                                Open Share Account
                        </label>
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="active">
                                Active
                        </label>
                    </div>

                    <!--
                     <div class="form-group">
                        <label for="username">Open Savings Account (<i>press ctrl and click to select multiple</i>)</label>
                        
                        <select multiple name="saving_account" class="form-control">

                            @foreach($savingproducts as $sacc)
                            <option value="{{ $sacc->id}}"> {{ $sacc->name}}</option>
                            @endforeach

                        </select>

                     </div>

                 -->

                </fieldset>


             </div>
</div>






<div class="row">


             <div class="col-lg-4 pull-right">
   
                <fieldset>
        
      
        
                        <div class="form-actions form-group">
        
                            <button type="submit" class="btn btn-primary btn-sm">Create Member</button>
                        </div>

                </fieldset>
            </div>

        </div>
</form>
		

  </div>

</div>
























@stop