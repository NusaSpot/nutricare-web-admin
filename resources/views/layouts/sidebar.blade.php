<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true" class="">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">Admin</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Pengaturan</h4>
                </li>
                <li class="nav-item {{ request()->is('user*') ? 'active submenu' : '' }}  {{ request()->is('admin*') ? 'active submenu' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-users"></i>
                        <p>Akun</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('user*') ? 'show' : '' }}  {{ request()->is('admin*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin*') ? 'active' : '' }}">
                                <a href="{{route('admin.index')}}">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('user*') ? 'active' : '' }}">
                                <a href="{{route('user.index')}}">
                                    <span class="sub-item">User</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('recipe*') ? 'active' : '' }}">
                    <a href="{{ route('recipe.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <p>Data Resep</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
