<!DOCTYPE html>
<html lang="en" ng-app="haiquan">
    @include('shared.head')    
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @include('shared.sidebar')
                @include('shared.topnav')
                <!-- page content -->
                <div class="right_col" role="main">
                    @yield('content')
                </div>
                <!-- /page content -->
                @include('shared.footer')
            </div>
        </div>
        @include('shared.scripts')       
    </body>
</html>