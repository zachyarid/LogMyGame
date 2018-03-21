<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
    </head>

    <body>
    @include('layouts.sidebar')

    @include('layouts.topbar')

    <!-- ##### MAIN PANEL ##### -->
    <div class="kt-mainpanel">
        <div class="kt-pagetitle">
            <h5>{{ $pageTitle }}</h5>
        </div><!-- kt-pagetitle -->

        <div class="kt-pagebody">
            @yield ('content')
        </div><!-- kt-pagebody -->

        <div class="kt-footer">
            <span>Copyright &copy; 2018. All Rights Reserved.</span>
            <span>Created by: Zach Yarid & Company</span>
        </div><!-- kt-footer -->
    </div><!-- kt-mainpanel -->

    @include('layouts.endbody')

    @hasSection('script-source')
        @yield ('script-source')
    @endif

    @hasSection('modals')
        @yield('modals')
    @endif
    </body>
</html>