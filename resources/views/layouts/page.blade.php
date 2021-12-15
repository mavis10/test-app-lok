<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>

    <body>
        <!-- Main navbar -->
        @include('includes.navbar')
        <!-- /main navbar -->

        <!-- Page content -->
        <div class="page-content">
            <!-- Main sidebar -->
            @include('includes.sidebar')
            <!-- /main sidebar -->

            <!-- Main content -->
            <div class="content-wrapper">
                @yield('content')
                @include('includes.footer')

                <!-- /core JS files -->
                @yield('stylesheet')
                @yield('javascript')
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->

    </body>
</html>
