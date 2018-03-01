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
        <div class="kt-pagebody">
            <!-- your content goes here -->
            @yield ('content')
        </div><!-- kt-pagebody -->
    </div><!-- kt-mainpanel -->

    @include('layouts.endbody')

    @hasSection('script-source')
        @yield ('script-source')
    @endif
    </body>
</html>