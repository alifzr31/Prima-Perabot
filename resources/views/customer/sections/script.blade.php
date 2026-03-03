<script src="{{ asset('assets/customer/js/script.js') }}"></script>
<script src="{{ url('https://code.jquery.com/jquery-3.7.1.min.js') }}"></script>
<script src="{{ url('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        loadCartBadge();
    });

    function loadCartBadge() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const badge = document.getElementById('cartBadge');

        if (badge) {
            badge.innerText = cart.length;
            badge.style.display = cart.length === 0 ? "none" : "inline-block";
        }
    }

    function addToCart(product) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        let index = cart.findIndex(item => item.product.id === product.id);

        if (index !== -1) {
            if (cart[index].qty != cart[index].product.stock) {
                cart[index].qty += 1;
                toastr.success('Produk berhasil ditambahkan ke keranjang', 'Berhasil');
            } else {
                toastr.warning('Stok produk terbatas/habis atau sudah tersedia di keranjang dengan jumlah maksimum', 'Masukkan ke Keranjang Gagal');
            }
        } else {
            cart.push({
                product: product,
                qty: 1,
            });
            toastr.success('Produk berhasil ditambahkan ke keranjang', 'Berhasil');
        }

        localStorage.setItem('cart', JSON.stringify(cart));

        loadCartBadge();
    }
</script>
@yield('custom-scripts')
