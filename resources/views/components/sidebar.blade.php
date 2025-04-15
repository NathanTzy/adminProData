<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">ProData</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <!-- Cek apakah user adalah owner -->
            @if(Auth::user()->role == 'owner')
                <!-- Akses penuh untuk owner -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-shop"></i><span>Mitra</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('distributor*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('distributor.index') }}">Distributors</a>
                        </li>
                        <li class="{{ Request::is('reseller*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('reseller.index') }}">Resellers</a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link" href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i><span>Inventory</span></a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Account Control</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('user*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">Distributors</a>
                        </li>
                        <li class="{{ Request::is('user-reseller*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('user-reseller.index') }}">Resellers</a>
                        </li>
                    </ul>
                </li>
            @elseif(Auth::user()->role == 'distributor')
                <!-- Akses distributor -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-shop"></i><span>Mitra</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('distributor*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('distributor.index') }}">Distributors</a>
                        </li>
                        <li class="{{ Request::is('reseller*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('reseller.index') }}">Resellers</a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link" href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i><span>Inventory</span></a></li>
            @elseif(Auth::user()->role == 'reseller')
                <!-- Akses reseller -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-shop"></i><span>Mitra</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('reseller*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('reseller.index') }}">Resellers</a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link" href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i><span>Inventory</span></a></li>
            @endif
        </ul>
    </aside>
</div>
