@auth
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="">STISLA</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="">STISLA</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Navigation</li>
                <li>
                    <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i><span>Beranda</span></a>
                </li>
                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="menu-header">Management</li>
                    <li class="{{ Request::is('admin/hakakses') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.hakakses.index') }}"><i class="fas fa-user-shield"></i>
                            <span>Hak Akses</span></a>
                    </li>
                    <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i>
                            <span>Products</span></a>
                    </li>
                    <li class="{{ Request::is('admin/orders*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-cart"></i>
                            <span>Pesanan</span></a>
                    </li>
                    <li class="{{ Request::is('admin/invoices*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.invoices.index') }}"><i class="fas fa-file-invoice"></i>
                            <span>Invoice</span></a>
                    </li>
                    <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog"></i>
                            <span>Pengaturan API</span></a>
                    </li>
                @endif
                <!-- Orders for regular users -->
                <li class="menu-header">Transaksi</li>
                <li class="{{ Request::is('orders*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-shopping-bag"></i>
                        <span>Pesanan Saya</span></a>
                </li>

                <!-- Shipping section -->
                <li class="menu-header">Pengiriman</li>
                <li class="{{ Request::is('shipping/check-ongkir') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('shipping.check-ongkir') }}"><i class="fas fa-truck"></i> <span>Cek
                            Ongkir</span></a>
                </li>
                <li class="{{ Request::is('shipping/track') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('shipping.track') }}"><i class="fas fa-search-location"></i>
                        <span>Lacak Kiriman</span></a>
                </li>
                {{-- <li class="{{ Request::is('shipping/test') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('shipping.test') }}"><i class="fas fa-map-marker-alt"></i>
                        <span>Test Shipping</span></a>
                </li> --}}

                <!-- profile ganti password -->
                <li class="menu-header">Profile</li>
                <li class="{{ Request::is('profile/edit') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('profile/edit') }}"><i class="far fa-user"></i>
                        <span>Profile</span></a>
                </li>
                <li class="{{ Request::is('profile/change-password') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('profile/change-password') }}"><i class="fas fa-key"></i> <span>Ganti
                            Password</span></a>
                </li>
                <li class="menu-header">Starter</li>
                <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank
                            Page</span></a>
                </li>
            </ul>
        </aside>
    </div>
@endauth
