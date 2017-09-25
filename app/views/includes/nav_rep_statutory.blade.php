 <nav class="navbar-default navbar-static-side" role="navigation">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ URL::to('payrollReports/selectNssfPeriod') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> NSSF Returns</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectNhifPeriod') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> NHIF Returns</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectPayePeriod') }}" target="_blank"><i class="glyphicon glyphicon-file fa-fw"></i> Paye Returns</a>
                    </li>
                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->