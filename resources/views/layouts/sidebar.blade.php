<!-- ##### SIDEBAR LOGO ##### -->
<div class="kt-sideleft-header">
    <div class="kt-logo"><a href="{{ route('home') }}">{{ env('APP_NAME') }}</a></div>
    <div id="ktDate" class="kt-date-today"></div>
    <div class="input-group kt-input-search">
        <input type="text" class="form-control" placeholder="Search...">
        <span class="input-group-btn mg-0">
      <button class="btn"><i class="fa fa-search"></i></button>
    </span>
    </div><!-- input-group -->
</div><!-- kt-sideleft-header -->

<!-- ##### SIDEBAR MENU ##### -->
<div class="kt-sideleft">
    <label class="kt-sidebar-label">Navigation</label>
    <ul class="nav kt-sideleft-menu">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
                <i class="icon ion-ios-home-outline"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- nav-item -->

        <li class="nav-item">
            <a href="{{ route('log-game.index') }}" class="nav-link">
                <i class="fa fa-plus"></i>
                <span>Log A Game</span>
            </a>
        </li><!-- nav-item -->
    </ul>
</div><!-- kt-sideleft -->