@extends('layouts.erp_ports')
@section('content')
<br/>





<div class="row">
    <div class="col-lg-12">
      <h3>
        Erp Reports &emsp;
        <a href="{{ URL::to('sendMergedMail') }}" class="btn btn-primary btn-sm pull-right">SEND REPORTS</a>
      </h3>
    <hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-12">

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> Email successfully sent!
    </div>
    @endif

    <ul>
        <li>
            <a href="{{ URL::to('erpReports/mergedReport') }}" target="_blank">MERGED REPORT</a>
       </li>
       <li>
            <a href="{{ URL::to('erpReports/selectSalesPeriod') }}">Sales Summary</a>
       </li>       

       <li>
         <a href="{{ URL::to('erpReports/selectSalesComparisonPeriod') }}">Monthly Sales Comparison</a>
       </li>

       <!-- <li>
         <a href="{{ URL::to('erpReports/selectSalesSummaryMonth') }}">Sales Summary By Customer Category</a>
       </li> -->

       <!-- <li>
            <a href="{{ URL::to('erpReports/sales_summary') }}" target="_blank">Sales Summary</a>
       </li> -->

       <li>
            <a href="{{ URL::to('erpReports/selectPurchasesPeriod') }}">Purchases</a>
       </li>

       <li>
            <a href="{{ URL::to('erpReports/clients') }}" target="_blank">Clients</a>
       </li>

       <li>
          <a href="{{ URL::to('erpReports/selectItemsPeriod') }}">Items</a>
       </li>

       <li>
          <a href="{{ URL::to('erpReports/selectExpensesPeriod') }}">Expenses</a>
       </li>
    
       <li>
          <a href="{{ URL::to('erpReports/paymentmethods') }}" target="_blank">Payment Methods</a>
       </li>  

       <li>
         <a href="{{ URL::to('erpReports/payments') }}" target="_blank">Payments</a>     
       </li>

       <li>
         <a href="{{ URL::to('daily_payments/pdf') }}" target="_blank">Daily Collections</a>
       </li>

        <li>
         <a href="{{ URL::to('erpReports/locations') }}" target="_blank">Stores</a>     
       </li> 

        <li>
         <a href="{{ URL::to('erpReports/stocks') }}" target="_blank">Stock report </a>     
       </li> 


        <li>
         <a href="{{ URL::to('erpReports/pricelist') }}" target="_blank">Price List </a>     
       </li>

        <li>
         <a href="{{ URL::to('erpReports/accounts') }}" target="_blank">Account Balances </a>     
       </li>

       <li>
            <a href="{{ URL::to('erpReports/selectVehiclesPeriod') }}">Vehicles</a>
       </li>  

       <li>
        <a href="reports/blank" target="_blank">Blank report template</a>
      </li>
    </ul>

  </div>

</div>

@stop