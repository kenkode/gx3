@extends('layouts.erp')

@section('content')

<br><div class="row">
  <div class="col-lg-12">
  <h4>Update Target</h4>

<hr>
</div>  
</div>


<div class="row">
  <div class="col-lg-5">

    
    
     @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

     <form method="POST" action="{{{ URL::to('salestargets/update/'.$salestarget->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        
        <div class="form-group">
            <label for="username">Month<span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="month" id="month" value="{{$salestarget->month}}" required>
        </div>

        <div class="form-group">
            <label for="username">Target Amount<span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="target_amount" id="target_amount" value="{{$salestarget->target_amount}}" required>
        </div>

        <div class="form-group">
                        <label for="username">Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{$salestarget->target_date}}">
                        </div>
          </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Target</button>
        </div>

    </fieldset>
</form>
    

  </div>

</div>

@stop