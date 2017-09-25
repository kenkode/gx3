 <nav class="navbar-default navbar-static-side" role="navigation">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ URL::to('payrollReports/selectPeriod') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Monthly Payslips</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectSummaryPeriod') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Payroll Summary</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectRemittancePeriod') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Pay Remittance</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectAllowance') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Allowance Report</a>
                    </li>  

                    <li>
                        <a href="{{ URL::to('payrollReports/selectDeduction') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Deduction Report</a>
                    </li>  

                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->