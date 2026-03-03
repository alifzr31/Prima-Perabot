@extends('customer.index')

@section('page-title', 'Beranda')

@section('custom-css')
    <style>
        /* =====================
                                                                                                       BEST SELLER

                                                                                                    ===================== */
        /* BEST WOW CARD */
        .best-wow {
            position: relative;
            overflow: hidden;
        }

        .best-wow img {
            transition: .4s ease;
        }

        .best-wow:hover img {
            transform: scale(1.08);
        }

        .best-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(45deg, #ff512f, #dd2476);
            color: #fff;
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: .5px;
            z-index: 2;
        }

        .best-brand {
            font-size: 12px;
            font-weight: 600;
            color: #2f56a6;
            margin-bottom: 4px;
        }

        .best-sku {
            font-size: 11px;
            color: #999;
            margin-bottom: 6px;
        }


        /**/
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp .6s ease forwards;
        }

        .fade-in:nth-child(1) {
            animation-delay: .1s
        }

        .fade-in:nth-child(2) {
            animation-delay: .2s
        }

        .fade-in:nth-child(3) {
            animation-delay: .3s
        }

        .fade-in:nth-child(4) {
            animation-delay: .4s
        }

        .fade-in:nth-child(5) {
            animation-delay: .5s
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .best-card {
            position: relative;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .08);
            transition: .4s;
        }

        .best-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 60px rgba(47, 86, 166, .25);
        }

        .best-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: linear-gradient(45deg, #ff512f, #dd2476);
            color: #fff;
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: .5px;
        }

        .best-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: .4s;
        }

        .best-card:hover .best-img {
            transform: scale(1.07);
        }

        .best-info {
            padding: 15px;
        }

        .best-brand {
            font-size: 12px;
            color: #2f56a6;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .best-sku {
            font-size: 11px;
            color: #999;
            margin-bottom: 6px;
        }

        .best-price {
            font-size: 18px;
            font-weight: 700;
            color: #e74c3c;
            margin: 10px 0;
        }

        .best-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: #2f56a6;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }

        .best-btn:hover {
            background: #1f3f82;
        }

        /**/
        /* ==============================
                                                                                                       AGGRESSIVE MARKETING MODE
                                                                                                    ================================ */

        .produk-card {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .18);
            transition: .35s ease;
        }

        .produk-card:hover {
            transform: translateY(-14px) scale(1.04);
            box-shadow: 0 40px 100px rgba(0, 0, 0, .3);
        }

        /* 🔥 BEST SELLER BADGE */
        .produk-card::before {
            content: "🔥 HOT SALE";
            position: absolute;
            top: 14px;
            left: 14px;
            background: linear-gradient(135deg, #ff0000, #ff6a00);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 20px;
            z-index: 3;
            animation: pulseBadge 1.5s infinite;
        }

        @keyframes pulseBadge {
            0% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.08)
            }

            100% {
                transform: scale(1)
            }
        }

        /* ⚡ STOK */
        .stok-warning {
            font-size: 12px;
            color: #e74c3c;
            font-weight: 600;
            margin-top: 6px;
            animation: blink 1.2s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        /* ⭐ RATING */
        .rating {
            color: #f1c40f;
            font-size: 13px;
            margin: 4px 0;
        }

        /* 💥 PRICE */
        .price-grosir {
            font-size: 22px;
            font-weight: 800;
            color: #e74c3c;
        }

        /* 🛒 BUTTON AGGRESSIVE */
        .btn-beli {
            background: linear-gradient(135deg, #ff0000, #ff7300);
            color: #fff;
            font-weight: 700;
            letter-spacing: .5px;
            transition: .3s;
        }

        .btn-beli:hover {
            transform: scale(1.08);
            box-shadow: 0 14px 35px rgba(255, 0, 0, .5);
        }

        /* ================= SELLING MODE PREMIUM ================= */

        .selling-mode .terlaris-card {
            position: relative;
            border-radius: 22px;
            box-shadow: 0 18px 45px rgba(0, 0, 0, .15);
            transition: .35s ease;
        }

        .selling-mode .terlaris-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, .25);
        }

        /* LABEL TERJUAL */
        .selling-mode .sold-count {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-top: 6px;
        }

        /* PROGRESS WRAPPER */
        .selling-mode .stock-wrapper {
            margin-top: 10px;
            margin-bottom: 16px;
            /* ⬅️ kasih jarak ke tombol */
        }


        /* TEXT HAMPIR HABIS */
        .selling-mode .stock-text {
            font-size: 12px;
            font-weight: 600;
            color: #e74c3c;
            margin-bottom: 6px;
        }

        /* PROGRESS BAR */
        .selling-mode .progress-bar {
            width: 100%;
            height: 8px;
            background: #ffe5e5;
            border-radius: 20px;
            overflow: hidden;
        }

        .selling-mode .progress-fill {
            height: 100%;
            background: #e74c3c;
            /* merah solid */
            border-radius: 20px;
            transition: width .6s ease;
        }

        .selling-mode .progress-fill.critical {
            animation: blinkBar 1s infinite;
        }

        @keyframes blinkBar {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .4
            }
        }

        /* BUTTON LEBIH POWER */
        .selling-mode .btn-beli {
            font-weight: 700;
            letter-spacing: .5px;
            transition: .3s;
        }

        .selling-mode .btn-beli:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(31, 60, 136, .4);
        }




        /* =====================
                                                                                                       GLOBAL
                                                                                                    ===================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f7f9fc;
            color: #333;
        }


        /* =====================
                                                                                                       BANNER
                                                                                                    ===================== */
        .hero-banner {
            position: relative;
            height: 420px;
            overflow: hidden;
            margin-top: 0;
        }

        .hero-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .45);
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: justify center;
            color: rgb(255, 255, 255);
            max-width: 900px;
        }

        .hero-text h1 {
            font-size: 24px;
            margin-bottom: 12px;
        }

        /* =====================
                                                                                                       CATEGORY
                                                                                                    ===================== */
        .category-colorful {
            padding: 70px 40px;
        }

        .category-colorful h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .colorful-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 26px;
            max-width: 1100px;
            margin: auto;
        }

        .color-card {
            position: relative;
            padding: 30px 24px;
            border-radius: 22px;
            text-decoration: none;
            color: #fff;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .12);
            transition: .35s ease;
        }

        /* badge */
        .badge {
            position: absolute;
            top: 18px;
            right: 18px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(255, 255, 255, .25);
            backdrop-filter: blur(6px);
        }

        /* icon */
        .color-card .material-icons {
            font-size: 38px;
            margin-bottom: 14px;
            display: inline-block;
        }

        /* text */
        .color-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .color-card p {
            font-size: 14px;
            opacity: .9;
        }

        /* hover effect */
        .color-card::before {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, .25);
            border-radius: 50%;
            top: -60px;
            right: -60px;
            opacity: 0;
            transition: .4s ease;
        }

        .color-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, .15);
            opacity: 0;
            transition: .35s ease;
        }

        .color-card:hover {
            transform: translateY(-10px) scale(1.04);
            box-shadow: 0 30px 60px rgba(0, 0, 0, .25);
        }

        .color-card:hover::before {
            opacity: 1;
            transform: scale(2.5);
        }

        .color-card:hover::after {
            opacity: 1;
        }

        /* animation */
        .color-card {
            opacity: 0;
            transform: translateY(40px);
            animation: fadeUp .7s ease forwards;
        }

        .color-card:nth-child(1) {
            animation-delay: .1s
        }

        .color-card:nth-child(2) {
            animation-delay: .2s
        }

        .color-card:nth-child(3) {
            animation-delay: .3s
        }

        .color-card:nth-child(4) {
            animation-delay: .4s
        }

        .color-card:nth-child(5) {
            animation-delay: .5s
        }

        .color-card:nth-child(6) {
            animation-delay: .6s
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* colors */
        .satu {
            background: linear-gradient(135deg, #003b46, #66a5ad)
        }

        .dua {
            background: linear-gradient(135deg, #2e4600, #a2c523);
        }

        .tiga {
            background: linear-gradient(135deg, #a43820, #f7987b);
        }

        .empat {
            background: linear-gradient(135deg, #5d535e, #9a9eab);
        }

        .lima {
            background: linear-gradient(135deg, #b38867, #ddbc95);
        }

        .enam {
            background: linear-gradient(135deg, #4f6457, #acd0c0);
        }

        .tujuh {
            background: linear-gradient(135deg, #a10115, #c0b2b5);
        }

        .delapan {
            background: linear-gradient(135deg, #283655, #d0e1f9);
        }

        .sembilan {
            background: linear-gradient(135deg, #d4ae01, #ffeea1);
        }

        /* =====================
                                                                                                       PRODUK TERLARIS
                                                                                                    ===================== */
        .produk-terlaris {
            padding: 70px 40px;
        }

        .produk-terlaris h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 28px;
            max-width: 1200px;
            margin: auto;
        }

        .produk-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .12);
            transition: .3s;
        }

        .produk-card:hover {
            transform: translateY(-8px);
        }

        .produk-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .produk-info {
            padding: 18px;
        }

        .price-normal {
            text-decoration: line-through;
            color: #999;
            font-size: 14px;
        }

        .price-grosir {
            color: #e74c3c;
            font-size: 18px;
            font-weight: 700;
        }

        .min-beli {
            font-size: 13px;
            color: #555;
            margin: 6px 0;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .btn-group button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-beli {
            background: #2f56a6;
            color: white;
        }

        .btn-detail {
            background: #eee;
        }

        /* =====================
                                                                                                       POPUP
                                                                                                    ===================== */
        .popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background: white;
            width: 90%;
            max-width: 900px;
            border-radius: 20px;
            padding: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .popup-images img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 26px;
            cursor: pointer;
        }

        /* =====================
                                                                                                       RESPONSIVE
                                                                                                    ===================== */
        @media(max-width:600px) {
            .colorful-wrapper {
                grid-template-columns: 1fr 1fr;
            }

            .color-card {
                min-height: 170px;
                padding: 26px 20px;
            }

            .popup-content {
                grid-template-columns: 1fr;
            }
        }

        .popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background: #fff;
            width: 90%;
            max-width: 900px;
            border-radius: 20px;
            padding: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            position: relative;
        }

        .popup-images img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .popup-info h2 {
            margin-bottom: 10px;
        }

        .popup-info p {
            margin-bottom: 6px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 26px;
            cursor: pointer;
        }

        @media(max-width:700px) {
            .popup-content {
                grid-template-columns: 1fr;
            }
        }

        /* SLIDER IMAGE POPUP */
        /* SLIDER IMAGE POPUP */
        .popup-images {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .popup-images img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            border-radius: 14px;
        }

        .slide-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, .5);
            color: white;
            border: none;
            font-size: 26px;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 50%;
        }

        .slide-btn.prev {
            left: 10px
        }

        .slide-btn.next {
            right: 10px
        }


        /* MOBILE MENU */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -260px;
            width: 260px;
            height: 100vh;
            background: #2f56a6;
            padding: 80px 20px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            transition: .3s;
            z-index: 998;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        /* ACTIVE */
        .mobile-menu.active {
            right: 0;
        }


        /* =====================
                                                                                                       PRODUK TERLARIS � FEATURED MEDIUM CARDS
                                                                                                    ===================== */
        .produk-terlaris {
            padding: 60px 40px;
            background: linear-gradient(180deg, #f7f9fc, #eef2f8);
        }

        .produk-terlaris h2 {
            max-width: 1200px;
            margin: 0 auto 28px;
            font-size: 24px;
        }

        /* SCROLL HORIZONTAL */
        .produk-grid {
            display: flex;
            gap: 22px;
            overflow-x: auto;
            padding-bottom: 14px;
            max-width: 1200px;
            margin: auto;
        }

        /* CARD LEBIH GEDE DARI KATEGORI */
        .produk-card {
            min-width: 320px;
            /* ?? lebih gede dari kategori */
            max-width: 320px;
            border-radius: 18px;
            box-shadow: 0 14px 30px rgba(0, 0, 0, .15);
            display: flex;
            flex-direction: column;
        }

        /* GAMBAR */
        .produk-card img {
            width: 100%;
            height: 220px;
            /* cocok foto 1:1 */
            object-fit: cover;
            border-radius: 18px 18px 0 0;
        }

        /* INFO */
        .produk-info {
            padding: 16px;
        }

        .produk-info h3 {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .price-normal {
            font-size: 13px;
        }

        .price-grosir {
            font-size: 18px;
        }

        .min-beli {
            font-size: 12px;
            margin: 6px 0;
        }

        /* BUTTON */
        .btn-group {
            gap: 10px;
        }

        .btn-group button {
            padding: 9px;
            font-size: 13px;
            border-radius: 8px;
        }

        /* SCROLL BAR */
        .produk-grid::-webkit-scrollbar {
            height: 7px;
        }

        .produk-grid::-webkit-scrollbar-thumb {
            background: #bbb;
            border-radius: 10px;
        }

        /* MOBILE */
        @media(max-width:600px) {
            .produk-card {
                min-width: 260px;
            }

            .produk-card img {
                height: 190px;
            }
        }

        /* MOBILE MENU */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -280px;
            width: 280px;
            height: 100vh;
            background: #2f56a6;
            padding: 90px 24px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            transition: .35s ease;
            z-index: 998;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        /* ACTIVE */
        .mobile-menu.active {
            right: 0;
        }




        /* =====================
                                                                                                       MOBILE MENU
                                                                                                    ===================== */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -280px;
            width: 280px;
            height: 100vh;
            background: #2f56a6;
            padding: 90px 24px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            transition: .35s ease;
            z-index: 1000;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        .mobile-menu.active {
            right: 0;
        }

        /* =====================
                                                                                                       OVERLAY BLUR
                                                                                                    ===================== */
        .menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .35);
            backdrop-filter: blur(6px);
            opacity: 0;
            pointer-events: none;
            /* ?? KUNCI */
            transition: .3s;
            z-index: 999;
        }

        .menu-overlay.active {
            opacity: 1;
            pointer-events: auto;
            /* BARU BISA DIKLIK */
        }


        /* =====================
                                                                                                       THINWALL GRID NORMAL
                                                                                                    ===================== */
        .thinwall-page .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 28px;
            overflow: visible;
            /* ?? MATIIN SCROLL */
        }

        .thinwall-page .produk-card {
            min-width: auto;
            max-width: 100%;
        }

        /* =====================
                                                                                                       THINWALL � GRID LIST VERTICAL
                                                                                                    ===================== */

        /* GRID NORMAL (BUKAN SCROLL) */
        #thinwallGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
            max-width: 1200px;
            margin: auto;
        }

        /* CARD */
        #thinwallGrid .produk-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
            transition: .25s ease;
            display: flex;
            flex-direction: column;
        }

        #thinwallGrid .produk-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
        }

        /* IMAGE (AMAN UNTUK FOTO 1:1) */
        #thinwallGrid .produk-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* INFO */
        #thinwallGrid .produk-info {
            padding: 16px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        #thinwallGrid .produk-info h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        /* PRICE */
        #thinwallGrid .price-normal {
            font-size: 13px;
            color: #999;
            text-decoration: line-through;
        }

        #thinwallGrid .price-grosir {
            font-size: 17px;
            font-weight: 700;
            color: #e74c3c;
            margin: 2px 0;
        }

        #thinwallGrid .min-beli {
            font-size: 12px;
            color: #555;
        }

        /* BUTTON */
        #thinwallGrid .btn-group {
            margin-top: auto;
            display: flex;
            gap: 10px;
        }

        #thinwallGrid .btn-group button {
            flex: 1;
            padding: 10px;
            font-size: 13px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            #thinwallGrid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:600px) {
            #thinwallGrid {
                grid-template-columns: 1fr;
            }
        }

        /* =====================
                                                                                                       BANNER KATEGORI
                                                                                                    ===================== */
        .kategori-banner {
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .kategori-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .kategori-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, .55),
                    rgba(0, 0, 0, .2));
        }

        .kategori-banner-text {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            max-width: 520px;
        }

        .kategori-banner-text h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .kategori-banner-text p {
            font-size: 15px;
            opacity: .9;
        }

        @media(max-width:600px) {
            .kategori-banner {
                height: 200px;
            }

            .kategori-banner-text {
                left: 20px;
            }

            .kategori-banner-text h1 {
                font-size: 24px;
            }
        }

        /* =====================
                                                                                                       THINWALL � RAPiH & FOTO 1:1
                                                                                                    ===================== */

        /* GRID */
        #thinwallGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 28px;
            /* jarak NORMAL & lega */
            max-width: 1200px;
            margin: auto;
        }

        /* CARD */
        #thinwallGrid .produk-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .1);
            transition: .25s ease;
        }

        #thinwallGrid .produk-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
        }

        /* IMAGE 1:1 (PALING PENTING) */
        #thinwallGrid .produk-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            /* ?? PAKSA 1:1 */
            object-fit: cover;
            /* isi penuh tanpa gepeng */
            background: #f2f2f2;
        }

        /* INFO */
        #thinwallGrid .produk-info {
            padding: 16px 16px 18px;
        }

        #thinwallGrid .produk-info h3 {
            font-size: 15px;
            font-weight: 600;
            line-height: 1.35;
            margin-bottom: 8px;
        }

        /* PRICE */
        #thinwallGrid .price-normal {
            font-size: 13px;
            color: #999;
            text-decoration: line-through;
        }

        #thinwallGrid .price-grosir {
            font-size: 17px;
            font-weight: 700;
            color: #e74c3c;
            margin: 2px 0;
        }

        #thinwallGrid .min-beli {
            font-size: 12px;
            color: #555;
            margin-bottom: 10px;
        }

        /* BUTTON */
        #thinwallGrid .btn-group {
            display: flex;
            gap: 10px;
        }

        #thinwallGrid .btn-group button {
            flex: 1;
            padding: 9px;
            font-size: 13px;
            border-radius: 8px;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            #thinwallGrid {
                grid-template-columns: repeat(2, 1fr);
                gap: 22px;
            }
        }

        @media(max-width:600px) {
            #thinwallGrid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* =====================
                                                                                                       THINWALL � RAPiH & FOTO 1:1
                                                                                                    ===================== */

        /* GRID */
        #thinwallGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 28px;
            /* jarak NORMAL & lega */
            max-width: 1200px;
            margin: auto;
        }

        /* CARD */
        #thinwallGrid .produk-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .1);
            transition: .25s ease;
        }

        #thinwallGrid .produk-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
        }

        /* IMAGE 1:1 (PALING PENTING) */
        /* GAMBAR PRODUK GRID � TIDAK DIPOTONG */
        #thinwallGrid .produk-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            /* tetap 1:1 */
            object-fit: contain;
            /* ?? PENTING: JANGAN DIPOTONG */
            background: #fff;
            /* latar netral */
            padding: 10px;
            /* ruang napas gambar */
        }

        /* INFO */
        #thinwallGrid .produk-info {
            padding: 16px 16px 18px;
        }

        #thinwallGrid .produk-info h3 {
            font-size: 15px;
            font-weight: 600;
            line-height: 1.35;
            margin-bottom: 8px;
        }

        /* PRICE */
        #thinwallGrid .price-normal {
            font-size: 13px;
            color: #999;
            text-decoration: line-through;
        }

        #thinwallGrid .price-grosir {
            font-size: 17px;
            font-weight: 700;
            color: #e74c3c;
            margin: 2px 0;
        }

        #thinwallGrid .min-beli {
            font-size: 12px;
            color: #555;
            margin-bottom: 10px;
        }

        /* BUTTON */
        #thinwallGrid .btn-group {
            display: flex;
            gap: 10px;
        }

        #thinwallGrid .btn-group button {
            flex: 1;
            padding: 9px;
            font-size: 13px;
            border-radius: 8px;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            #thinwallGrid {
                grid-template-columns: repeat(2, 1fr);
                gap: 22px;
            }
        }

        @media(max-width:600px) {
            #thinwallGrid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* =====================
                                                                                                       THINWALL CARD � FOTO & BORDER 1:1
                                                                                                    ===================== */

        #thinwallGrid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 34px;
            max-width: 1200px;
            margin: auto;
        }

        /* CARD */
        #thinwallGrid .produk-card {
            background: #fff;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .1);
            transition: .25s ease;
        }

        #thinwallGrid .produk-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
        }

        /* === FOTO WRAPPER (INI KUNCINYA) === */
        #thinwallGrid .produk-card img {
            width: 100%;
            aspect-ratio: 1 / 4;
            /* ?? CARD FOTO 1:1 */
            object-fit: contain;
            /* gambar UTUH */
            background: #fff;
            padding: 12px;
            display: block;
        }

        /* INFO */
        #thinwallGrid .produk-info {
            padding: 16px;
        }

        #thinwallGrid .produk-info h3 {
            font-size: 15px;
            font-weight: 600;
            line-height: 1.35;
            margin-bottom: 8px;
        }

        /* PRICE */
        #thinwallGrid .price-normal {
            font-size: 13px;
            color: #999;
            text-decoration: line-through;
        }

        #thinwallGrid .price-grosir {
            font-size: 17px;
            font-weight: 700;
            color: #e74c3c;
            margin: 2px 0;
        }

        #thinwallGrid .min-beli {
            font-size: 12px;
            color: #555;
            margin-bottom: 12px;
        }

        /* BUTTON */
        #thinwallGrid .btn-group {
            display: flex;
            gap: 10px;
        }

        #thinwallGrid .btn-group button {
            flex: 1;
            padding: 9px;
            font-size: 13px;
            border-radius: 8px;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            #thinwallGrid {
                grid-template-columns: repeat(2, 1fr);
                gap: 22px;
            }
        }

        @media(max-width:600px) {
            #thinwallGrid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        /* HP */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .product-card {
            padding: 8px;
            border-radius: 8px;
            font-size: 12px;
        }

        .product-card img {
            width: 100%;
            height: 90px;
            object-fit: cover;
        }

        /* =====================
                                                                                                       POPUP FINAL (OVERRIDE)
                                                                                                    ===================== */
        .popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .65);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup.show {
            display: flex;
        }

        /* LOCK BACKGROUND */
        body.popup-open {
            overflow: hidden;
            height: 100vh;
        }

        /* CLOSE BUTTON */
        .popup .close {
            position: absolute;
            top: 14px;
            right: 16px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
        }

        /* =====================
                                                                                                       BRAND CLEAN GRID
                                                                                                    ===================== */
        .brand-clean {
            padding: 80px 40px;
            background: #fff;
        }

        .brand-clean h2 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 6px;
        }

        .brand-sub {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 40px;
        }

        /* GRID RAPIH */
        .brand-clean-grid {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 24px;
        }

        /* ITEM */
        /* =====================
                                                                                                       BRAND CLEAN GRID – COLORFUL DEFAULT
                                                                                                    ===================== */

        /* ITEM */
        .brand-item {
            position: relative;
            border-radius: 16px;
            padding: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .3s ease;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        /* LOGO */
        .brand-item img {
            max-width: 100%;
            max-height: 70px;
            object-fit: contain;
            opacity: 1;
            transition: .3s ease;
        }

        /* DEFAULT COLOR BACKGROUND */
        .brand-item::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            opacity: .35;
            /* 🔥 warna langsung terlihat */
            z-index: -1;
            transition: .3s ease;
        }

        /* HOVER EFFECT */
        .brand-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .18);
        }

        .brand-item:hover::after {
            opacity: .55;
            /* lebih hidup saat hover */
        }

        /* WARNA PER ITEM */
        .c1::after {
            background: #2f56a6;
        }

        .c2::after {
            background: #ffcc33;
        }

        .c3::after {
            background: #2ecc71;
        }

        .c4::after {
            background: #290238;
        }

        .c5::after {
            background: #e67e22;
        }

        .c6::after {
            background: #1abc9c;
        }

        .c7::after {
            background: #e74c3c;
        }

        .c8::after {
            background: #34495e;
        }

        .c9::after {
            background: #f39c12;
        }

        .c10::after {
            background: #16a085;
        }

        .c11::after {
            background: #2980b9;
        }

        .c12::after {
            background: #8e44ad;
        }

        .c13::after {
            background: #27ae60;
        }

        .c14::after {
            background: #d35400;
        }

        .c15::after {
            background: #c0392b;
        }

        .c16::after {
            background: #7f8c8d;
        }

        .c17::after {
            background: #f1c40f;
        }

        .c18::after {
            background: #3498db;
        }

        .c19::after {
            background: #e84393;
        }

        .c20::after {
            background: #00b894;
        }

        .c21::after {
            background: #CD5C5C;
        }

        .c22::after {
            background: #7FFF00;
        }

        .c23::after {
            background: #E6E6FA;
        }

        .c24::after {
            background: #ADD8E6;
        }

        .c25::after {
            background: #D8BFD8;
        }

        .c26::after {
            background: #4682B4;
        }



        /* ===== PROFILE POPUP ===== */
        .profile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: .35s ease;
            z-index: 9999;
        }

        .profile-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        /* POPUP BOX */
        .profile-popup {
            background: rgba(255, 255, 255, .95);
            border-radius: 20px;
            padding: 30px 28px;
            width: 100%;
            max-width: 300px;
            text-align: center;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .35);
            transform: scale(.8) translateY(30px);
            opacity: 0;
            transition: .35s ease;
        }

        /* ACTIVE */
        .profile-overlay.show .profile-popup {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        /* CLOSE */
        .close-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            font-size: 22px;
            cursor: pointer;
            color: #777;
        }

        /* AVATAR */
        .profile-avatar {
            font-size: 64px;
            color: #2f56a6;
            margin-bottom: 10px;
        }

        /* TEXT */
        .profile-popup h3 {
            margin-bottom: 6px;
            color: #1f2f5c;
        }

        .profile-popup p {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* LOGOUT BUTTON */
        .logout-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: #e74c3c;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }

        .logout-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(231, 76, 60, .4);
        }

        /* ================= TERLARIS ================= */
        .terlaris-section {
            padding: 40px 20px;
            background: #fff;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 22px;
            font-weight: 600;
        }

        .terlaris-wrapper {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 10px;
        }

        .terlaris-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .terlaris-wrapper::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .terlaris-card {
            min-width: 220px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            padding: 14px;
            cursor: pointer;
            transition: .25s ease;
        }

        .terlaris-card:hover {
            transform: translateY(-5px);
        }

        .terlaris-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
        }

        .terlaris-name {
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
            min-height: 38px;
        }

        .terlaris-price {
            margin-top: 6px;
            font-weight: 700;
            color: #2f56a6;
        }

        .badge-terlaris {
            position: absolute;
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 20px;
            top: 10px;
            left: 10px;
        }

        .terlaris-section {
            padding: 50px 20px;
            background: #f7f9fc;
            text-align: center;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .terlaris-wrapper {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            justify-content: flex-start;
            /* WAJIB */
        }


        .terlaris-card {
            min-width: 250px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            padding: 16px;
            position: relative;
            transition: .3s;
        }

        .terlaris-card:hover {
            transform: translateY(-6px);
        }

        .terlaris-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 14px;
        }

        .badge-terlaris {
            position: absolute;
            top: 14px;
            left: 14px;
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .terlaris-name {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 600;
            min-height: 42px;
        }

        .terlaris-price {
            margin-top: 8px;
            font-weight: 700;
            color: #2f56a6;
        }

        .btn-beli {
            margin-top: 14px;
            width: 100%;
            padding: 10px;
            border: none;
            background: #2ecc71;
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-beli:hover {
            background: #27ae60;
        }

        /* ================= FLASH SALE SECTION ================= */

        .terlaris-section {
            padding: 60px 20px;
            background: linear-gradient(135deg, #f8fbff, #eef3ff);
        }

        .terlaris-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto 30px auto;
        }

        .terlaris-header h2 {
            font-size: 26px;
            font-weight: 700;
        }

        .countdown {
            background: #2f56a6;
            color: #fff;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1px;
        }

        /* PRODUCT LIST */

        .terlaris-wrapper {
            display: flex;
            gap: 22px;
            overflow-x: auto;
            padding-bottom: 10px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .terlaris-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .terlaris-wrapper::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 20px;
        }

        /* CARD */

        .terlaris-card {
            min-width: 240px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .08);
            padding: 16px;
            transition: .3s ease;
            position: relative;

            display: flex;
            flex-direction: column;
            /* 🔥 KUNCI */
        }


        .terlaris-card:hover {
            transform: translateY(-6px);
        }

        /* 1:1 IMAGE */

        .image-wrapper {
            width: 100%;
            aspect-ratio: 1/1;
            overflow: hidden;
            border-radius: 14px;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* BADGE */

        .badge-terlaris {
            position: absolute;
            top: 16px;
            left: 16px;
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* TEXT */

        .terlaris-name {
            margin-top: 14px;
            font-size: 14px;
            font-weight: 600;

            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* maksimal 3 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 60px;
            /* 🔥 tinggi tetap */
        }


        .terlaris-price {
            margin-top: 8px;
            font-weight: 700;
            font-size: 16px;
            color: #2f56a6;
        }

        /* BUTTON */

        .btn-beli {
            margin-top: auto;
            width: 100%;
            padding: 11px;
            border: none;
            background: #1f3c88;
            /* Biru tua */
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: .25s;
        }

        .btn-beli:hover {
            background: #162f6a;
        }
    </style>
@endsection

@section('page-content')
    <section class="hero-banner">
        <img src="{{ asset('assets/customer/images/banner.png') }}" alt="Banner Prima Perabot">
        <div class="hero-overlay"></div>

        <div class="hero-text">
            <h1>Solusi Lengkap Perabotan dan Peralatan </br> Untuk Rumah & Bisnis Anda</h1>
            <p>Harga Grosir ✔ Kualitas Premium ✔ Pengiriman Cepat ✔</p>
        </div>
    </section>

    <section class="category-colorful">
        <h2>Kategori Produk</h2>

        <div class="colorful-wrapper">
            @for ($i = 0; $i < $categories->count() + 1; $i++)
                @if ($i >= $categories->count())
                    <a href="/pages/katalog.html" class="color-card sembilan" data-page="lainnya">
                        <span class="material-icons">dynamic_feed</span>
                        <h3>lainnya</h3>
                        <p>Lengkapi Kebutuhan</p>
                    </a>
                @else
                    <a href="#"
                        class="color-card @if ($i == 0) satu @elseif ($i == 1) dua @elseif ($i == 2) tiga @elseif ($i == 3) empat @elseif ($i == 4) lima @elseif ($i == 5) enam @elseif ($i == 6) tujuh @elseif ($i == 7) delapan @endif"
                        data-page="{{ $categories[$i]->slug }}">
                        @if ($categories[$i]->is_popular)
                            <span class="badge">Popular</span>
                        @endif
                        <span class="material-icons">chair_alt</span>
                        <h3>{{ $categories[$i]->name }}</h3>
                        <p>{{ Str::limit($categories[$i]->description, 30) }}</p>
                    </a>
                @endif
            @endfor
        </div>
    </section>

    <section class="brand-clean">
        <h2>Brand Partner</h2>
        <p class="brand-sub">Dipercaya oleh berbagai brand & pelaku usaha</p>

        <div class="brand-clean-grid">
            @for ($i = 0; $i < $brands->count() + 1; $i++)
                @if ($i >= $brands->count())
                    <a href="/pages/katalog.html" class="brand-item c25">
                        <span class="material-icons">dynamic_feed</span>
                        <p>Lainnya</p>
                    </a>
                @else
                    <a href="#" class="brand-item c1">
                        <img src="{{ asset('storage/' . $brands[$i]->logo) }}" alt="{{ $brands[$i]->name }}">
                    </a>
                @endif
            @endfor
        </div>
    </section>

    <section class="promo-slider-section">
        <div class="promo-slider">
            <button class="slider-btn prev">&#10094;</button>
            <div class="slider-wrapper">
                <a href="/pages/produk.html?kategori=Kursi%20%26%20Bangku" class="slide active"
                    style="background-image:url('https://down-aka-id.img.susercontent.com/id-11134210-8224p-mhh1k4qttc7af2.webp')">
                </a>
                <a href="/pages/produk.html?kategori=Rak%20%26%20Lemari%20Serbaguna" class="slide active"
                    style="background-image:url('https://down-tx-id.img.susercontent.com/id-11134210-8224x-mh73svw4xtl699.webp')">
                </a>
                <a href="/pages/produk.html?kategori=Keranjang%20Penyimpanan%20(Barang%2C%20Pakaian%2C%20Buah)"
                    class="slide active"
                    style="background-image:url('https://down-aka-id.img.susercontent.com/id-11134210-82250-mh73svw3m2a66c.webp')">
                </a>
                <a href="/pages/produk.html?brand=LNH" class="slide active"
                    style="background-image:url('https://down-aka-id.img.susercontent.com/id-11134210-8224q-mhr4n9topb0k40.webp')">
                </a>
                <a href="/pages/produk.html?kategori=Rak%20%26%20Lemari%20Serbaguna" class="slide active"
                    style="background-image:url('https://down-tx-id.img.susercontent.com/id-11134210-8224r-mh73svw00u193a.webp')">
                </a>
            </div>
            <button class="slider-btn next">&#10095;</button>
        </div>
        <div class="slider-dots"></div>
    </section>

    <section class="terlaris-section selling-mode">
        <h2>🔥 Hot Piks 🔥</h2>
        <p class="brand-sub">Produk pilihan yang paling banyak di beli pelanggan</p>

        <div class="terlaris-header"></div>
        </div>

        <div class="terlaris-wrapper" id="terlarisList">
            @foreach ($products as $product)
                <div class="terlaris-card">
                    @if ($product->is_hot_sale)
                        <span class="badge-terlaris">HOT SALE</span>
                    @endif
                    <div class="image-wrapper"
                        style="max-width: 240px; display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('storage/' . $product->productImage->first()->image_path) }}"
                            alt="{{ $product->name }}">
                    </div>

                    <div class="terlaris-name">{{ $product->name }}</div>
                    <div class="terlaris-price">
                        @if ($product->discount_percent)
                            <small style="color: grey;">
                                <s>
                                    {{ $product->formatted_price }}
                                </s>
                            </small><br />
                        @endif
                        {{ $product->formatted_final_price }}
                    </div>
                    <div class="sold-count">
                        🔥 {{ $product->checkoutItems->count() }} terjual
                    </div>
                    <div class="stock-wrapper">
                        <div class="stock-text">
                            ⚡ Sisa {{ $product->stock }} pcs lagi!
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill ${stockClass}" style="width:${percent}%"></div>

                        </div>
                    </div>

                    <button class="btn-beli" onclick="return addToCart({{ $product }});">
                        Masukkan ke Keranjang
                    </button>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('custom-scripts')
    <script></script>
@endsection
