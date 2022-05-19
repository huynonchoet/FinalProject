<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">DashBoard</li>
                <li>
                    <a href="{{ route('admin.index') }}">
                        <i class="metismenu-icon fas fa-sort-amount-up-alt"></i>
                        Statistics of System
                    </a>
                    @php
                        $user = \App\Models\User::find(auth()->id());
                    @endphp
                    @if ($user->role == '2')
                        <a href="{{ route('admin.incomes') }}">
                            <i class="metismenu-icon fa-solid fa-money-bill-transfer"></i>
                            System Earnings Statistics
                        </a>
                    @endif
                </li>
                <li class="app-sidebar__heading">User Management</li>
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="metismenu-icon fas fa-thin fa-users"></i>
                        Users Management
                    </a>
                </li>
                <li class="app-sidebar__heading">Reports Management</li>
                <li>
                    <a href="{{ route('admin.reports.comments.index') }}">
                        <i class="metismenu-icon fas fa-comments"></i>
                        Reports Comment
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports.homestays.index') }}">
                        <i class="metismenu-icon fas fa-thin fa-house-fire"></i>
                        Reports Homestay
                    </a>
                </li>
                <li class="app-sidebar__heading">Room directory management</li>
                <li>
                    <a href="{{ route('admin.type-rooms.index') }}">
                        <i class="metismenu-icon fas fa-folder"></i>
                        Room directory management
                    </a>
                </li>
                <li class="app-sidebar__heading">Tax Management</li>
                <li>
                    <a href="{{ route('admin.taxs.index') }}">
                        <i class="metismenu-icon fa-solid fa-circle-dollar-to-slot"></i>
                        Tax management
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
