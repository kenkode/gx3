
 <nav class="navbar-default navbar-static-side" role="navigation" id="wrap">
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">
                    
                    <li>
                        <a href="{{ URL::to('accounts') }}"><i class="glyphicon glyphicon-user fa-fw"></i> Chart of Accounts</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-newspaper-o fa-fw"></i>Journal Entries<i class="fa fa-caret-down fa-fw"></i></a>
                        
                        <ul class="nav">
                            <li><a href="{{ URL::to('journals') }}"><i class="fa fa-newspaper-o fa-fw"></i> Journal Entries</a></li>
                            <li><a href="{{ URL::to('journals/create') }}"><i class="fa fa-plus fa-fw"></i> New Entry</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-university fa-fw"></i> Banking<i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="nav">
                            <li><a href="{{ URL::to('bankAccounts') }}"><i class="fa fa-university fa-fw"></i> Bank Accounts</a></li>
                            <li><a href="{{ URL::to('bankReconciliation/report') }}"><i class="fa fa-file fa-fw"></i> Reconciliation Report</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-list fa-fw"></i>Expenses<i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="nav">
                            <li><a href="{{ URL::to('expenses') }}"><i class="fa fa-money fa-fw"></i>Expenses</a></li>
                            <li><a href="{{ URL::to('petty_cash') }}"><i class="fa fa-money fa-fw"></i>Petty Cash</a></li>
                            <li><a href="{{ URL::to('expense_claims') }}"><i class="fa fa-money fa-fw"></i>Expense Claims</a></li>
                        </ul>
                    </li> 

                    <li>
                        <a href="{{ URL::to('assetManagement') }}"><i class="fa fa-building fa-fw"></i>Asset Management</a>
                    </li>

                    <!--<li>
                        <a href="#"  >
                            <i class="fa fa-bank fa-lg"></i>  Bank Accounts <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="nav ">
                            <li>
                                <a href="{{ URL::to('maintenances') }}"><i class="fa fa-th fa-fw"></i>  Maintenance</a>
                            </li>
                            
                            
                            <li>
                                <a href="{{ URL::to('tests') }}"><i class="fa fa-list fa-fw"></i> Tests</a>
                            </li>
                            
                        </ul>
                    </li>-->

                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->