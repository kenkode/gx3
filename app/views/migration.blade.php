@extends('layouts.payroll')
@section('content')

<br><br>
		
				



<div class="row">
	
	<div class="col-lg-12">
  DATA MIGRATION
		<hr>

    @if (Session::get('notice'))
            <div class="alert alert-success">{{ Session::get('notice') }}</div>
        @endif


<p><strong>Migrate Employees</strong></p>

<a href="{{URL::to('template/employees')}}" > <i class="glyphicon glyphicon-file"></i> Download Employees Template</a>
    <p>&nbsp;</p>
    <form method="post" action="{{URL::to('import/employees')}}" accept-charset="UTF-8" enctype="multipart/form-data">

    <div class="form-group">

        <label>Upload Employees  (excel)</label>
        <input type="file" class="" name="employees" />
            
    </div>
    
      
      <button type="submit" class="btn btn-primary">Import Employees</button>
    </form>

<!-- ############################################################  -->

    <hr>
<p><strong>Migrate Earnings</strong></p>

<a href="{{URL::to('template/earnings')}}" > <i class="glyphicon glyphicon-file"></i> Download Earnings Template</a>
    <p>&nbsp;</p>
   <form method="post" action="{{URL::to('import/earnings')}}" accept-charset="UTF-8" enctype="multipart/form-data">

      <div class="form-group">

        <label>Upload Earnings  (excel)</label>
        <input type="file" class="" name="earnings" />
            
    </div>
    
      
      <button type="submit" class="btn btn-primary">Import Earnings</button>

    </form>








    <!-- ############################################################  -->

    <hr>
<p><strong>Migrate Allowances</strong></p>

<a href="{{URL::to('template/allowances')}}" > <i class="glyphicon glyphicon-file"></i> Download Allowances Template</a>
    <p>&nbsp;</p>
    <form method="post" action="{{URL::to('import/allowances')}}" accept-charset="UTF-8" enctype="multipart/form-data">

      <div class="form-group">

        <label>Upload Allowances  (excel)</label>
        <input type="file" class="" name="allowances" />
            
    </div>
    
      
      <button type="submit" class="btn btn-primary">Import Allowances</button>

    </form>





    <!-- ############################################################  -->

    <hr>
<p><strong>Migrate Reliefs</strong></p>

<a href="{{URL::to('template/reliefs')}}" > <i class="glyphicon glyphicon-file"></i> Download Relief Template</a>
    <p>&nbsp;</p>
    <form method="post" action="{{URL::to('import/reliefs')}}" accept-charset="UTF-8" enctype="multipart/form-data">

      <div class="form-group">

        <label>Upload Relief  (excel)</label>
        <input type="file" class="" name="reliefs" />
            
    </div>
    
      
      <button type="submit" class="btn btn-primary">Import Relief</button>

    </form>




    <!-- ############################################################  -->

    <hr>
<p><strong>Migrate Deductions</strong></p>

<a href="{{URL::to('template/deductions')}}" > <i class="glyphicon glyphicon-file"></i> Download Deduction Template</a>
    <p>&nbsp;</p>
    <form method="post" action="{{URL::to('import/deductions')}}" accept-charset="UTF-8" enctype="multipart/form-data">

      <div class="form-group">

        <label>Upload Deductions (excel)</label>
        <input type="file" class="" name="deductions" />
            
    </div>
    
      
      <button type="submit" class="btn btn-primary">Import Deductions</button>

    </form>







	</div>
</div>



	

	

@stop