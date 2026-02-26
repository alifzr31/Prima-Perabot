<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('dashboard.home') }}">
            <img src="{{ asset('assets/global/images/logo.svg') }}" alt="Prima Perabot" width="20%;">
            Prima Perabot
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('dashboard.home') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house1"></span><span class="mtext">Beranda</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-library"></span><span class="mtext">Data Master</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dashboard.brand') }}">Data Merk</a></li>
                        <li><a href="{{ route('dashboard.category') }}">Data Kategori Produk</a></li>
                        <li><a href="{{ route('dashboard.product') }}">Data Produk</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <span class="micon dw dw-invoice"></span><span class="mtext">Data Pembelian</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#">Data Pesanan</a></li>
                        <li><a href="#">Data Pembeli</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('dashboard.user') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-group"></span><span class="mtext">Data Pengguna</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
