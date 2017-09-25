@extends('layouts.pay_ports')
@section('content')
<br/>





<div class="row">
    <div class="col-lg-12">
  <h3>Payroll Reports</h3>

<hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-12">

    <ul>

       <li>
            <a href="{{ URL::to('payrollReports/selectPeriod') }}" target="_blank"> Monthly Payslips</a>
       </li>

       <li>
          <a href="{{ URL::to('payrollReports/selectSummaryPeriod') }}" target="_blank">Payroll Summary</a>
       </li>

       <li>
          <a href="{{ URL::to('payrollReports/selectRemittancePeriod') }}" target="_blank">Pay Remittance</a>
       </li>
    
       <li>
          <a href="{{ URL::to('payrollReports/selectAllowance') }}" target="_blank"> Allowance Report</a>
       </li>  

       <li>
         <a href="{{ URL::to('payrollReports/selectDeduction') }}" target="_blank"> Deduction Report</a>     
       </li>  

       <li>
        <a href="reports/blank" target="_blank">Blank report template</a>
      </li>
    </ul>

  </div>

</div>

@stop