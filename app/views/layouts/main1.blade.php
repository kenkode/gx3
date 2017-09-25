@include('includes.head')
@include('includes.nav')
@include('includes.nav_main')

<div id="page-wrapper" style="width:2670px;">
            <div class="row" >
                <div class="col-lg-12">
                    @yield('content')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
@include('includes.footer')