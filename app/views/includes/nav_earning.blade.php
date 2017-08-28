 <nav class="navbar-default navbar-static-side" role="navigation">

            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">
                    
                    <li>
                        <a href="{{ URL::to('allowances') }}"><i class="glyphicon glyphicon-home fa-fw"></i> Allowances</a>
                    </li>

                     <li>
                        <a href="{{ URL::to('reliefs') }}"><i class="fa fa-list fa-fw"></i> Relief</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('deductions') }}"><i class="fa fa-list fa-fw"></i> Deductions</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('nssf') }}"><i class="fa fa-list fa-fw"></i> Nssf Rates</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('nhif') }}"><i class="fa fa-list fa-fw"></i> Nhif Rates</a>
                    </li>
                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->