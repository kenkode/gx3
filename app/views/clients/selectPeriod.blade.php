@extends('layouts.erp')
@section('content')
<br/>

<div class="row">
  <div class="col-lg-12">
  <h4>Select Period</h4>

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
    
    <script type="text/javascript">
      $(document).ready(function(){
        $("#date_today").datepicker("setDate", new Date());
      });
    </script>

    <form method="GET" action="{{URL::to('erpReports/clientstatement')}}" accept-charset="UTF-8" target="_blank">
        <input type="hidden" name="client_id" value="{{$id}}">
        <fieldset>

            <div class="form-group">
              <label for="username"> Date <span style="color:red">*</span></label>
              <div class="right-inner-addon ">
                <i class="glyphicon glyphicon-calendar"></i>
                <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="date" id="date_today" value="{{{ Input::old('to') }}}" required>
              </div>
            </div>

            <div class="form-group">
              <label for="username">From<span style="color:red">*</span></label>
              <div class="right-inner-addon ">
                <i class="glyphicon glyphicon-calendar"></i>
                <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="from" id="from" value="{{{ Input::old('from') }}}" required>
              </div>
            </div>

            <div class="form-group">
              <label for="username">To <span style="color:red">*</span></label>
              <div class="right-inner-addon ">
                <i class="glyphicon glyphicon-calendar"></i>
                <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="to" id="to" value="{{{ Input::old('to') }}}" required>
              </div>
            </div>
            
            
            <div class="form-actions form-group">
            
              <button type="submit" class="btn btn-primary btn-sm" >Select</button>
            </div>

        </fieldset>
    </form>
    

  </div>

</div>


@stop