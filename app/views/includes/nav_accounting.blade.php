 <nav class="navbar-default navbar-static-side" role="navigation">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">
                    
                    <li>
                        <a href="{{ URL::to('accounts') }}"><i class="glyphicon glyphicon-user fa-fw"></i> Chart of Accounts</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('journals') }}"><i class="fa fa-barcode fa-fw"></i> Journal Entries</a>
                    </li>


                    <li>
                        <a href="{{ URL::to('journals/create') }}"><i class="fa fa-check fa-fw"></i> Add Journal Entry</a>
                    </li> 

                      <li>
                        <a href="{{ URL::to('expenses') }}"><i class="fa fa-list fa-fw"></i> Expenses</a>
                      </li>

                    
                    <li>
                        <a href="#"><i class="fa fa-university fa-fw"></i> Banking<i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="nav">
                            <li><a href="{{ URL::to('bankAccounts') }}"><i class="fa fa-university fa-fw"></i> Bank Accounts</a></li>
                            <li><a href="{{ URL::to('bankReconciliation/report') }}"><i class="fa fa-file fa-fw"></i> Reconciliation Report</a></li>
                        </ul>
                        
                    </li>

                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->