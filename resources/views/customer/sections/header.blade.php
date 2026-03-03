<header class="header-adv">

    <a href="{{ route('ecomm.home') }}" class="logo">
        <img src="{{ asset('assets/global/images/logo.svg') }}" alt="Prima Perabot">
        <span>PRIMA <strong>PERABOT</strong></span>
    </a>

    <nav class="nav-menu">
        <a href="{{ route('ecomm.home') }}">Home</a>
        <a href="/pages/katalog.html">Kategori</a>
        <a href="/index.html#promo-borong">Promo</a>
        <a href="/#tentang-prima">Tentang</a>
        <a href="#">Kontak</a>
    </nav>

    <div class="header-action">
        <div class="cart-icon" onclick="window.location.href='{{ route('ecomm.checkout') }}'">
            <span class="material-icons">shopping_cart</span>
            <span class="cart-badge" id="cartBadge">0</span>
        </div>
        <span class="material-icons" onclick="toggleProfile()" style="cursor:pointer">account_circle</span>
        <span id="userBox" style="margin-left:12px;font-size:13px;"></span>
    </div>
</header>

<div id="profileOverlay" class="profile-overlay">
    <div class="profile-popup">

        <span class="material-icons close-btn" onclick="closeProfile()">close</span>

        <div class="profile-avatar">
            <span class="material-icons">account_circle</span>
        </div>

        <h3>Profil Akun</h3>
        <p id="profileName"></p>

        <button class="logout-btn" onclick="logout()">Logout</button>

    </div>
</div>
