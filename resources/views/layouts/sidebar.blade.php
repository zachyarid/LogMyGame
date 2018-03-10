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
            <a href="" class="nav-link with-sub">
                <i class="fa fa-eye"></i>
                <span>View</span>
            </a>
            <ul class="nav-sub" style="display: none;">
                <li class="nav-item"><a href="{{ route('game.index') }}" class="nav-link">Games</a></li>
                <li class="nav-item"><a href="{{ route('payment.index') }}" class="nav-link">Payments</a></li>
                <li class="nav-item"><a href="{{ route('mileage.index') }}" class="nav-link">Mileage Logs</a></li>
                <li class="nav-item"><a href="{{ route('gametype.index') }}" class="nav-link">Game Types</a></li>
                <li class="nav-item"><a href="{{ route('gamelocation.index') }}" class="nav-link">Game Locations</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('game.create') }}" class="nav-link">
                <i class="fa fa-plus"></i>
                <span>Log A Game</span>
            </a>
        </li><!-- nav-item -->

        <li class="nav-item">
            <a href="{{ route('payment.create') }}" class="nav-link">
                <i class="fa fa-money"></i>
                <span>Log A Payment</span>
            </a>
        </li><!-- nav-item -->

        <li class="nav-item">
            <a href="" class="nav-link with-sub">
                <i class="fa fa-automobile"></i>
                <span>Mileage Log</span>
            </a>
            <ul class="nav-sub" style="display: none;">
                <li class="nav-item"><a href="{{ route('mileage.pretrip') }}" class="nav-link">Start Pre-Trip</a></li>
                <li class="nav-item"><a href="{{ route('mileage.create') }}" class="nav-link">Log Mileage</a></li>
            </ul>
        </li><!-- nav-item -->
    </ul>
</div><!-- kt-sideleft -->