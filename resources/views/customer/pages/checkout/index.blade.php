@extends('customer.index')

@section('page-title', 'Keranjang')

@section('custom-css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }

        body {
            background: #f7f9fc;
            color: #333;
        }

        header {
            background: #2f56a6;
            color: #fff;
            padding: 18px 30px;
            font-size: 18px;
            font-weight: 600;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f2f4f8;
            font-size: 14px;
        }

        td img {
            width: 70px;
            border-radius: 8px;
        }

        .qty-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .qty-box button {
            width: 28px;
            height: 28px;
            border: none;
            background: #2f56a6;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        .remove {
            color: #e74c3c;
            cursor: pointer;
            font-weight: 600;
        }

        .total-box {
            margin: 20px 0;
            padding: 16px;
            background: #f8faff;
            border-radius: 12px;
            border: 1px solid #e3e8f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-box h2 {
            font-size: 20px;
        }

        .checkout-btn {
            background: #2ecc71;
            color: #fff;
            padding: 14px 26px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .checkout-action {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
        }

        /* MOBILE */
        @media (max-width: 600px) {
            .checkout-action {
                justify-content: stretch;
            }

            .checkout-action .checkout-btn {
                width: 100%;
            }
        }

        /* EMPTY */
        .empty {
            text-align: center;
            padding: 60px;
            color: #777;
        }

        /* TOAST */
        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #333;
            color: #fff;
            padding: 14px 18px;
            border-radius: 10px;
            opacity: 0;
            transform: translateY(20px);
            transition: 0.4s;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== CHECKOUT MINI NAV ===== */
        .checkout-nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #fff;
            padding: 12px 16px;
            display: flex;
            gap: 10px;
            border-bottom: 1px solid #eee;
        }

        .checkout-nav button {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border: none;
            border-radius: 10px;
            background: #f2f4f8;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.25s;
        }

        .checkout-nav button:hover {
            background: #e8ecf6;
            transform: translateY(-2px);
        }

        .checkout-nav .material-icons {
            font-size: 18px;
            color: #2f56a6;
        }

        /* ===== CHECKOUT HEADER ===== */
        .checkout-header {
            background: #2f56a6;
            color: #fff;
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* LEFT */
        .checkout-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-left .material-icons {
            font-size: 26px;
        }

        .checkout-left h1 {
            font-size: 20px;
            font-weight: 600;
        }

        /* RIGHT ACTION */
        .checkout-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-right button {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .checkout-right button .material-icons {
            font-size: 18px;
        }

        .checkout-right button:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* MOBILE */
        @media (max-width: 600px) {
            .checkout-right button {
                padding: 8px;
            }

            .checkout-right button span:last-child {
                display: none;
            }
        }

        /*STYLE DETAIL PEMESAN*/
        .checkout-section {
            margin-top: 30px;
            background: #fafafa;
            padding: 20px;
            border-radius: 14px;
        }

        .checkout-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 600;
            margin: 18px 0 10px;
            color: #777;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group small {
            font-size: 12px;
            color: #888;
        }

        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
        }

        /*sampai sini*/

        /* ============================= */
        /* RESPONSIVE MOBILE CART TABLE */
        /* ============================= */
        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 16px;
                border: 1px solid #eee;
                border-radius: 12px;
                padding: 10px;
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 8px 6px;
                border: none;
            }

            td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 13px;
                color: #666;
            }

            td img {
                width: 60px;
            }

            .qty-box {
                justify-content: flex-start;
            }
        }

        /* ============================= */
        /* RESPONSIVE FORM & BUTTON */
        /* ============================= */
        @media (max-width: 600px) {
            .container {
                margin: 20px 10px;
                padding: 16px;
            }

            .checkout-section {
                padding: 16px;
            }

            .total-box {
                flex-direction: column;
                gap: 12px;
                align-items: stretch;
            }

            .checkout-btn {
                width: 100%;
            }

            .checkout-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .checkout-right {
                width: 100%;
                justify-content: space-between;
            }
        }

        .error-text {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        input.error {
            border-color: #e74c3c;
        }

        /* ============================= */
        /* CART CARD MOBILE IMPROVED */
        /* ============================= */
        @media (max-width: 768px) {
            tbody tr {
                background: #fff;
                border-radius: 14px;
                padding: 14px;
                margin-bottom: 14px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            }

            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 4px;
                font-size: 14px;
            }

            td[data-label="Produk"] {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
                font-weight: 600;
            }

            td[data-label="Produk"] img {
                width: 80px;
                margin-bottom: 6px;
            }

            td[data-label="Harga"],
            td[data-label="Subtotal"] {
                font-weight: 600;
                color: #2f56a6;
            }

            .qty-box {
                gap: 12px;
            }

            .qty-box button {
                width: 32px;
                height: 32px;
                font-size: 18px;
            }

            .remove {
                font-size: 20px;
                color: #e74c3c;
            }
        }

        .total-box {
            position: sticky;
            bottom: 0;
            background: #f8faff;
            box-shadow: 0 -6px 20px rgba(0, 0, 0, 0.08);
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page-content')
    <div class="container">
        <table id="cartTable">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="total-box">
            <div>
                <h2>Total: Rp <span id="totalPrice">0</span></h2>
                <small id="diskonNote" style="color: #27ae60; font-size: 13px; display: none">
                    *Diskon 20% otomatis untuk produk Hampers dengan total
                    pembelian di atas 10 pcs
                </small>
            </div>
        </div>

        <form action="#" method="POST" id="checkoutForm" class="checkout-section">
            @csrf
            <div style="margin-bottom: 20px;">
                <h3>Informasi Pengiriman</h3>
                <small>Kolom dengan tanda (<span style="color: red;">*</span>) wajib diisi</small>
            </div>
            <hr />

            <p class="section-title">DATA PEMESAN</p>

            <div class="form-group">
                <label>Nama Pemesan<span style="color: red;">*</span></label>
                <input type="text" name="orderer_name" id="orderer_name" />
            </div>

            <div class="form-group">
                <label>Email Pemesan<span style="color: red;">*</span></label>
                <input type="email" name="orderer_email" id="orderer_email" placeholder="contoh@email.com" />

                <small class="error-text" id="emailError"></small>
            </div>

            <div class="form-group">
                <label>No. Handphone Pemesan<span style="color: red;">*</span></label>
                <input type="tel" name="orderer_phone" id="orderer_phone" placeholder="08xxxxxxxxxx" inputmode="numeric"
                    pattern="08[0-9]{8,11}" />

                <small class="error-text" id="hpError"></small>
            </div>

            <p class="section-title">PENGIRIMAN</p>

            <div class="form-group">
                <label>Nama Penerima<span style="color: red;">*</span></label>
                <input type="text" name="receiver_name" id="receiver_name" />
            </div>

            <div class="form-group">
                <label>Alamat Lengkap<span style="color: red;">*</span></label>
                <textarea name="receiver_address" id="receiver_address" rows="4" style="resize: none;"></textarea>
                <small>Pastikan anda memberikan kami alamat yang
                    lengkap</small>
            </div>

            <div class="form-group">
                <label>Negara<span style="color: red;">*</span></label>
                <input type="text" name="receiver_country" id="receiver_country" value="Indonesia" readonly />
            </div>

            <div class="form-group">
                <label>Provinsi<span style="color: red;">*</span></label>
                <select name="receiver_province" id="receiver_province">
                    <option selected disabled>-- Pilih Provinsi --</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kota/Kabupaten<span style="color: red;">*</span></label>
                <select name="receiver_city" id="receiver_city" disabled>
                    <option value="">-- Pilih Kota / Kabupaten --</option>
                </select>
            </div>

            <div class="form-group">
                <label>Kecamatan<span style="color: red;">*</span></label>
                <select name="receiver_district" id="receiver_district" disabled>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>

            <div class="form-group">
                <label>Kelurahan/Desa<span style="color: red;">*</span></label>
                <select name="receiver_sub_district" id="receiver_sub_district" disabled>
                    <option value="">-- Pilih Kelurahan / Desa --</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kode Pos<span style="color: red;">*</span></label>
                <input type="number" name="receiver_postal_code" id="receiver_postal_code" placeholder="Contoh: 40552" />
            </div>

            <div class="form-group">
                <label>Pesan Khusus</label>
                <textarea name="notes" id="notes" rows="4" style="resize: none;"></textarea>
            </div>

            <div class="checkout-action">
                <button type="submit" class="checkout-btn" id="btnCheckout">
                    Lanjutkan Checkout
                </button>
            </div>
        </form>
    </div>
@endsection

@section('custom-scripts')
    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {

            e.preventDefault();

            const cart = JSON.parse(localStorage.getItem("cart")) || [];

            if (cart.length === 0) {
                alert('Cart kosong');
                return;
            }

            const cartMapped = cart.map(item => ({
                product_id: item.product.id,
                price: item.product.price,
                qty: item.qty
            }));

            const ordererName = document.getElementById('orderer_name');
            const ordererEmail = document.getElementById('orderer_email');
            const ordererPhone = document.getElementById('orderer_phone');
            const receiverName = document.getElementById('receiver_name');
            const receiverAddress = document.getElementById('receiver_address');
            const receiverCountry = document.getElementById('receiver_country');
            const receiverProvince = document.getElementById('receiver_province');
            const receiverCity = document.getElementById('receiver_city');
            const receiverDistrict = document.getElementById('receiver_district');
            const receiverSubDistrict = document.getElementById('receiver_sub_district');
            const receiverPostalCode = document.getElementById('receiver_postal_code');
            const notes = document.getElementById('notes');

            const region = {
                province: receiverProvince.options[receiverProvince.selectedIndex].text,
                city: receiverCity.options[receiverCity.selectedIndex].text,
                district: receiverDistrict.options[receiverDistrict.selectedIndex].text,
                sub_district: receiverSubDistrict.options[receiverSubDistrict.selectedIndex].text,
            };

            const formData = {
                orderer_name: ordererName.value,
                orderer_email: ordererEmail.value,
                orderer_phone: ordererPhone.value,
                receiver_name: receiverName.value,
                receiver_address: receiverAddress.value,
                receiver_country: receiverCountry.value,
                receiver_province: region.province,
                receiver_city: region.city,
                receiver_district: region.district,
                receiver_sub_district: region.sub_district,
                receiver_postal_code: receiverPostalCode.value,
                notes: notes.value,
                items: cartMapped,
            };

            fetch("{{ route('ecomm.checkout.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        localStorage.removeItem("cart");
                        const checkoutData = data.data.checkout_data;

                        const date = new Date().toLocaleDateString("id-ID", {
                            day: "numeric",
                            month: "long",
                            year: "numeric",
                        });
                        let message = "";
                        message +=
                            "*==================================================*\n";
                        message +=
                            "                                  *```INVOICE PEMESANAN```*\n";
                        message +=
                            "                                     *```PRIMA PERABOT```*\n";
                        message +=
                            "*==================================================*\n";
                        message += `📅Tanggal : ${date}\n`;
                        message += `👤 Pemesan : ${checkoutData.orderer_name}\n\n`;
                        message += `📞 HP : ${checkoutData.orderer_phone}\n`;
                        message += `📧 Email : ${checkoutData.orderer_email}\n\n`;

                        message += "*DETAIL PRODUK*\n";
                        message +=
                            "--------------------------------------------------\n";

                        let total = 0;

                        checkoutData.checkout_items.forEach((item, index) => {
                            let subtotal = item.subtotal;

                            const isHampers =
                                item.product_name &&
                                item.product_name.toLowerCase().includes("hampers");

                            if (isHampers && item.qty > 10) {
                                const discount = Math.round(subtotal * 0.2);
                                subtotal -= discount;

                                message += `${index + 1}. ${item.product_name}\n`;
                                message += `   SKU      : ${item.product.sku}\n`;
                                message += `   Qty      : ${item.qty}\n`;
                                message += `   Harga    : Rp ${item.price.toLocaleString("id-ID")}\n`;
                                message += `   Diskon   : 20%\n`;
                                message += `   Subtotal : Rp ${subtotal.toLocaleString("id-ID")}\n\n`;
                            } else {
                                message += `${index + 1}. ${item.product_name}\n`;
                                message += `   SKU      : ${item.product.sku}\n`;
                                message += `   Qty      : ${item.qty}\n`;
                                message += `   Harga    : Rp ${item.price.toLocaleString("id-ID")}\n`;
                                message += `   Subtotal : Rp ${subtotal.toLocaleString("id-ID")}\n\n`;
                            }

                            total += subtotal;
                        });

                        message +=
                            "--------------------------------------------------\n";
                        message += `*TOTAL : Rp ${total.toLocaleString("id-ID")}*\n\n`;

                        message += "🚚 *PENGIRIMAN*\n";
                        message += `Penerima : ${checkoutData.receiver_name}\n`;
                        message += `Alamat : ${checkoutData.receiver_address}\n`;
                        message += `Provinsi : ${checkoutData.receiver_province}\n`;
                        message += `Kota : ${checkoutData.receiver_city}\n`;
                        message += `Kecamatan : ${checkoutData.receiver_district}\n`;
                        message += `Kelurahan : ${checkoutData.receiver_sub_district}\n\n`;
                        message += `Kode Pos : ${checkoutData.receiver_postal_code}\n\n`;

                        if (checkoutData.notes) {
                            message += `📝 Catatan : ${checkoutData.notes}\n\n`;
                        }
                        message +=
                            "*==================================================*\n";
                        message +=
                            "   *```Terima kasih telah berbelanja di Prima Perabot```*\n";
                        message +=
                            "*==================================================*";

                        // =============================
                        // REDIRECT KE WHATSAPP
                        // =============================
                        // const whatsappNumber = "6282218688837"; // GANTI NOMOR TOKO
                        const whatsappNumber = "6281312306787"; // GANTI NOMOR TOKO
                        const whatsappUrl =
                            `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;

                        window.open(whatsappUrl, "_blank");
                        window.location.href = '{{ route('ecomm.home') }}';

                        toastr.success('Checkout berhasil', 'Berhasil');
                    } else {
                        toastr.error('Checkout gagal', data.message || 'Terjadi kesalahan');
                    }
                })
                .catch(err => {
                    toastr.error('Checkout gagal', err || 'Terjadi kesalahan');
                });

        });
    </script>

    <script>
        $(document).ready(function() {
            loadCartTable();
        });

        function loadCartTable() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const $tbody = $("#cartTable tbody");

            $tbody.empty();

            if (cart.length === 0) {
                $tbody.append(`
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="empty">
                                Keranjang masih kosong
                            </div>
                        </td>
                    </tr>
                `);
                return;
            }

            $.each(cart, function(index, item) {
                const product = item.product;
                const qty = item.qty;
                const discountPrice = product.discount_percent ? calculateDiscount(product.price, product
                    .discount_percent) : product.price;
                const subtotal = product.discount_percent ? discountPrice * item.qty : product.price * item.qty;

                $tbody.append(`
                    <tr>
                        <td>
                            ${product.name}<br />
                            <small style="font-size:12px;color:#777">
                                SKU: ${product.sku ?? '-'}
                            </small>
                        </td>
                        <td>Rp ${formatRupiah(product.price)}</td>
                        <td>${product.discount_percent ? product.discount_percent + '%' : '-'}</td>
                        <td>
                            <div class="qty-box">
                                <button id="min-qty" data-index="${index}">−</button>
                                ${item.qty}
                                <button id="add-qty" data-index="${index}">+</button>
                            </div>
                        </td>
                        <td>Rp ${formatRupiah(subtotal)}</td>
                        <td class="remove" id="remove-item" data-index="${index}">
                            x
                        </td>
                    </tr>
                `);
            });
        }

        function loadCartBadge() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const badge = document.getElementById('cartBadge');

            if (badge) {
                badge.innerText = cart.length;
                badge.style.display = cart.length === 0 ? "none" : "inline-block";
            }
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat("id-ID").format(number);
        }

        function calculateDiscount(price, discountPercent) {
            return price - (price * discountPercent / 100);
        }

        $(document).on("click", "#add-qty", function() {
            const index = $(this).data("index");

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart[index].qty != cart[index].product.stock) {
                cart[index].qty += 1;
            }
            localStorage.setItem("cart", JSON.stringify(cart));

            loadCartTable();
            loadCartBadge();
        });

        $(document).on("click", "#min-qty", function() {
            const index = $(this).data("index");

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart[index].qty == 1) {
                cart.splice(index, 1);
            } else {
                cart[index].qty -= 1;
            }
            localStorage.setItem("cart", JSON.stringify(cart));

            loadCartTable();
            loadCartBadge();
        });

        $(document).on("click", "#remove-item", function() {
            const index = $(this).data("index");

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));

            loadCartTable();
            loadCartBadge();
        });
    </script>

    <script>
        const API_BASE_URL = "https://www.emsifa.com/api-wilayah-indonesia/api";

        function resetSelect(selector, placeholder) {
            $(selector)
                .html(`<option value="">${placeholder}</option>`)
                .prop('disabled', true);
        }

        function loadOptions(url, targetSelector, placeholder) {
            resetSelect(targetSelector, 'Loading...');

            $.get(url)
                .done(function(data) {
                    let options = `<option value="">${placeholder}</option>`;

                    data.forEach(item => {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    });

                    $(targetSelector)
                        .html(options)
                        .prop('disabled', false);
                })
                .fail(function() {
                    alert('Gagal mengambil data wilayah.');
                    resetSelect(targetSelector, placeholder);
                });
        }

        $('#receiver_province').on('change', function() {
            let provinceId = $(this).val();

            resetSelect('#receiver_city', '-- Pilih Kota / Kabupaten --');
            resetSelect('#receiver_district', '-- Pilih Kecamatan --');
            resetSelect('#receiver_sub_district', '-- Pilih Kelurahan / Desa --');

            if (provinceId) {
                loadOptions(
                    `${API_BASE_URL}/regencies/${provinceId}.json`,
                    '#receiver_city',
                    '-- Pilih Kota / Kabupaten --'
                );
            }
        });

        $('#receiver_city').on('change', function() {
            let cityId = $(this).val();

            resetSelect('#receiver_district', '-- Pilih Kecamatan --');
            resetSelect('#receiver_sub_district', '-- Pilih Kelurahan / Desa --');

            if (cityId) {
                loadOptions(
                    `${API_BASE_URL}/districts/${cityId}.json`,
                    '#receiver_district',
                    '-- Pilih Kecamatan --'
                );
            }
        });

        $('#receiver_district').on('change', function() {
            let districtId = $(this).val();

            resetSelect('#receiver_sub_district', '-- Pilih Kelurahan / Desa --');

            if (districtId) {
                loadOptions(
                    `${API_BASE_URL}/villages/${districtId}.json`,
                    '#receiver_sub_district',
                    '-- Pilih Kelurahan / Desa --'
                );
            }
        });
    </script>
@endsection
