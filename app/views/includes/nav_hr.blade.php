 <nav class="navbar-default navbar-static-side" role="navigation">

            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ URL::to('departments') }}"><i class="fa fa-list fa-fw"></i> Departments</a>
                    </li>
                    
                    <li>
                        <a href="{{ URL::to('banks') }}"><i class="fa fa-users fa-fw"></i> Banks</a>
                    </li>

                     <li>
                        <a href="{{ URL::to('bank_branch') }}"><i class="fa fa-users fa-fw"></i> Bank Branches</a>
                    </li>
                    
                    <li>
                        <a href="{{ URL::to('employee_type') }}"><i class="fa fa-users fa-fw"></i> Employee Types</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('job_group') }}"><i class="fa fa-users fa-fw"></i> Job Groups</a>
                    </li>
                
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->