@extends('layouts.main')

@section('content')
<br/>

<div class="row">
  <div class="col-lg-12">
  <h3>New Employee</h3>

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

     <form method="POST" action="{{{ URL::to('employees') }}}" accept-charset="UTF-8">

            <div class="row">
            
<!--
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

-->
            <div class="col-lg-4">

                 <fieldset>
                   <div class="form-group"><h3 style='color:Green;strong'>Personal Details</h3></div>

                    <div class="form-group">
                        <label for="username">Personal File Number <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="personal_file_number" id="personal_file_number" value="{{{ Input::old('personal_file_number') }}}" >
                    </div>

                    <div class="form-group">
                        <label for="username">Surname <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="lname" id="lname" value="{{{ Input::old('lname') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">First Name <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="fname" id="fname" value="{{{ Input::old('fname') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Other Names </label>
                        <input class="form-control" placeholder="" type="text" name="mname" id="mname" value="{{{ Input::old('mname') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">ID Number <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="identity_number" id="identity_number" value="{{{ Input::old('identity_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Passport number</label>
                        <input class="form-control" placeholder="" type="text" name="passport_number" id="passport_number" value="{{{ Input::old('passport_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Work Permit Number</label>
                        <input class="form-control" placeholder="" type="text" name="work_permit_number" id="work_permit_number" value="{{{ Input::old('work_permit_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Job Title</label>
                        <input class="form-control" placeholder="" type="text" name="jtitle" id="jtitle" value="{{{ Input::old('jtitle') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Date of birth</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker1" readonly="readonly" placeholder="" type="text" name="dob" id="dob" value="{{{ Input::old('dob') }}}">
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Marital Status</label>
                        <select name="status" class="form-control">
                            <option></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Separated">Separated</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Others">Others</option>
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Citizenship</label>
                        <select name="citizenship" class="form-control">
                            <option></option>
                            <option value="Kenyan">Kenyan</option>
                            <option value="Ugandian">Ugandan</option>
                            <option value="Tanzanian">Tanzanian</option>
                            <option value="Others">Others</option>
                        </select>
                
                    </div>


                    <div class="form-group">
                        <label for="username">Date joined</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="djoined" id="djoined" value="{{{ Input::old('djoined') }}}">
                        </div>
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
                    <div class="form-group"><h3 style='color:Green;strong'>Pin Information</h3></div>
                    <div class="form-group">
                        <label for="username">KRA Pin</label>
                        <input class="form-control" placeholder="" type="text" name="pin" id="pin" value="{{{ Input::old('pin') }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Nssf Number</label>
                        <input class="form-control" placeholder="" type="text" name="social_security_number" id="social_security_number" value="{{{ Input::old('social_security_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Nhif Number</label>
                        <input class="form-control" placeholder="" type="text" name="hospital_insurance_number" id="hospital_insurance_number" value="{{{ Input::old('hospital_insurance_number') }}}">
                    </div>
                     </fieldset>

                     <fieldset>
                      
                      <div class="form-group"><h3 style='color:Green;strong;margin-top:15px'>Deductions Applicable</h3></div>

                        <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="i_tax">
                              Apply Income Tax
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="i_tax_relief">
                               Apply Income Tax Relief
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="a_nssf">
                               Apply Nssf
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="a_nhif">
                                Apply Nhif
                        </label>
                    </div>
                     </fieldset>
                     

                     <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Payment Information</h3></div>

                    <div class="form-group">
                        <label for="username">Mode of Payment</label>
                        <select name="modep" class="form-control">
                            <option></option>
                            <option value="Bank">Bank</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                
                    </div>                    

                    <div class="form-group">
                        <label for="username">Bank</label>
                        <select name="bank_id" class="form-control">
                            <option></option>
                            @foreach($banks as $bank)
                            <option value="{{ $bank->id }}"> {{ $bank->bank_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                      
                     <div class="form-group">
                        <label for="username">Bank Branch</label>
                        <select name="bbranch_id" class="form-control">
                            <option></option>
                            @foreach($bbranches as $bbranch)
                            <option value="{{$bbranch->id }}"> {{ $bbranch->bank_branch_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Bank Account Number</label>
                        <input class="form-control" placeholder="" type="text" name="bank_account_number" id="bank_account_number" value="{{{ Input::old('bank_account_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Bank Eft Code</label>
                        <input class="form-control" placeholder="" type="text" name="bank_eft_code" id="bank_eft_code" value="{{{ Input::old('bank_eft_code') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Swift Code</label>
                        <input class="form-control" placeholder="" type="text" name="swift_code" id="swift_code" value="{{{ Input::old('swift_code') }}}">
                    </div>


              </fieldset>

            </div>

            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Branch Information</h3></div>
                    <div class="form-group">
                        <label for="username">Employee Branch</label>
                        <select name="branch_id" class="form-control">
                            <option></option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}"> {{ $branch->name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Employee Department</label>
                        <select name="department_id" class="form-control">
                            <option></option>
                            @foreach($departments as $department)
                            <option value="{{$department->id }}"> {{ $department->department_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                     <div class="form-group">
                        <label for="username">Job Group</label>
                        <select name="jgroup_id" class="form-control">
                            <option></option>
                            @foreach($jgroups as $jgroup)
                            <option value="{{ $jgroup->id }}"> {{ $jgroup->job_group_name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Employee Type</label>
                        <select name="type_id" class="form-control">
                            <option></option>
                            @foreach($etypes as $etype)
                            <option value="{{$etype->id }}"> {{ $etype->employee_type_name }}</option>
                            @endforeach

                        </select>
                
                    </div>
                    
                    <div style='margin-top:0px'></div>

                    <fieldset>

                    <div class="form-group"><h3 style='color:Green;strong'>Contact Information</h3></div>
                    <div class="form-group">
                        <label for="username">Phone Number</label>
                        <input class="form-control" placeholder="" type="text" name="telephone_mobile" id="telephone_mobile" value="{{{ Input::old('telephone_mobile') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Office Email</label>
                        <input class="form-control" placeholder="" type="text" name="email_office" id="email_office" value="{{{ Input::old('email_office') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Personal Email</label>
                        <input class="form-control" placeholder="" type="text" name="email_personal" id="email_personal" value="{{{ Input::old('email_personal') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Postal Zip</label>
                        <input class="form-control" placeholder="" type="text" name="zip" id="zip" value="{{{ Input::old('zip') }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Postal Address</label>
                        <textarea class="form-control"  name="address" id="address">{{{ Input::old('address') }}}</textarea>
                    </div>

                   <div class="form-group" style='margin-top:0px;'>
                    <div class="form-group"><h3 style='color:Green;strong'>Salary Information</h3></div>
            
                        <label for="username">Basic Salary</label>
                        <input class="form-control" placeholder="" type="text" name="pay" id="pay" value="{{{ Input::old('pay') }}}">
                    </div>
        
                   </fieldset>
                  
                   <fieldset>
                    
                     <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="active">
                                In Employment
                        </label>
                    </div>
                      
                    </fieldset>

                    <div style='margin-top:50px'></div>

                    </fieldset>
                        <div class="form-actions form-group">
        
                            <button type="submit" class="btn btn-primary btn-sm">Create Employee</button>
                        </div>

                    
                </fieldset>

            </div>
</div>


<div class="row">


             <div class="col-lg-12"><hr>

                
<div class="row">


             <div class="col-lg-4">

                 <fieldset>
                    


                </fieldset>


             </div>


             <div class="col-lg-4">

                 
                     </div>


             
</div>






<div class="row">


             <div class="col-lg-4 pull-right">
   
                
            </div>

        </div>
</form>
    

  </div>

</div>


@stop