<!-- ##### HEAD PANEL ##### -->
<div class="kt-headpanel">
    <div class="kt-headpanel-left">
        <a id="naviconMenu" href="" class="kt-navicon d-none d-lg-flex"><i class="icon ion-navicon-round"></i></a>
        <a id="naviconMenuMobile" href="" class="kt-navicon d-lg-none"><i class="icon ion-navicon-round"></i></a>
    </div><!-- kt-headpanel-left -->

    <div class="kt-headpanel-right">
        <div class="dropdown dropdown-profile">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                <img src="{{ Storage::disk('public')->url('avatars/' . Auth::id() . '.jpeg') }}" class="wd-32 rounded-circle" alt="">
                <span class="logged-name"><span class="hidden-xs-down">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span> <i class="fa fa-angle-down mg-l-3"></i></span>
            </a>
            <div class="dropdown-menu wd-200">
                <ul class="list-unstyled user-profile-nav">
                    <li><a href="{{ route('profile') }}"><i class="icon ion-ios-person-outline"></i> My Profile</a></li>
                    <li><a href="{{ route('import.index') }}"><i class="icon ion-upload"></i> Import Data</a></li>
                    <li><a href="{{ route('export.index') }}"><i class="icon ion-archive"></i> Export Data</a></li>
                    <li><a href="{{ route('logout') }}"><i class="icon ion-power"></i> Sign Out</a></li>
                </ul>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
    </div><!-- kt-headpanel-right -->
</div><!-- kt-headpanel -->
<div class="kt-breadcrumb">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <!--<span class="breadcrumb-item active"></span>-->
    </nav>
</div><!-- kt-breadcrumb -->