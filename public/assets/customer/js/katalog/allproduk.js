const LIMIT = 100;
let currentPage = 1;
let semuaProduk = [];
let produkTampil = [];

/* ======================
   LOAD DATA
====================== */
fetch("../data/katalog.json")
  .then(res => res.json())
  .then(data => {
    semuaProduk = data;
    produkTampil = [...semuaProduk];
    renderPage();
  })
  .catch(err => console.error("Gagal load katalog.json", err));

/* ======================
   EVENT TOOLBAR
====================== */
document.getElementById("searchInput")?.addEventListener("input", applyFilter);
document.getElementById("sortSelect")?.addEventListener("change", applyFilter);
document.getElementById("filterPrice")?.addEventListener("change", applyFilter);

/* ======================
   PAGINATION
====================== */
function renderPage() {
  const start = (currentPage - 1) * LIMIT;
  const end = start + LIMIT;
  const pageData = produkTampil.slice(start, end);

  renderProduk(pageData);
  updatePagination();
}

/* ======================
   RENDER PRODUK
====================== */
function renderProduk(list){
  const container = document.getElementById("produkList");
  container.innerHTML = "";

  if (list.length === 0) {
    container.innerHTML = "<p>Produk belum tersedia</p>";
    return;
  }

list.forEach(p => {

  const fotos = [
    p.main_image,
    p.image_2,
    p.image_3,
    p.image_4,
    p.image_5,
    p.image_6
  ].filter(Boolean);

  const fotoData = encodeURIComponent(JSON.stringify(fotos));

  const sku =
  p["sku induk"] ||
  p["sku"] ||
  "";

const dataProduk = encodeURIComponent(JSON.stringify({
  name: p["nama produk"],
  price: p.harga,
  image: fotos[0],
  sku: p.sku
}));



  container.innerHTML += `
    <div class="product-card" data-foto="${fotoData}">
      <img src="${fotos[0] || ''}"
           alt="${p['nama produk']}"
           onclick="openGallery(this.parentElement)">

      <div class="info">
        <h4 class="product-title">${p['nama produk']}</h4>

       ${(p["sku"] || p["sku induk"]) ? 
  `<div class="product-sku">SKU: ${p["sku"] || p["sku induk"]}</div>` 
  : ""}


        <div class="product-action">
          <div class="product-price">
            Rp ${Number(p.harga).toLocaleString("id-ID")}
          </div>

          <button class="btn-cart"
            onclick="addToCart(event, '${dataProduk}')">
            <span class="material-icons">add_shopping_cart</span>
            Keranjang
          </button>
        </div>
      </div>
    </div>
  `;
});

}

/* ======================
   FILTER + SORT
====================== */
function applyFilter(){
  const keyword = document.getElementById("searchInput")?.value.toLowerCase() || "";
  const sortVal = document.getElementById("sortSelect")?.value || "";
  const priceVal = document.getElementById("filterPrice")?.value || "";

  let result = [...semuaProduk];

  // SEARCH
  if (keyword) {
    result = result.filter(p =>
      p["nama produk"].toLowerCase().includes(keyword)
    );
  }

  // FILTER HARGA
  if (priceVal) {
    const [min, max] = priceVal.split("-").map(Number);
    result = result.filter(p => p.harga >= min && p.harga <= max);
  }

  // SORT
  if (sortVal === "name-asc") {
    result.sort((a,b)=> a["nama produk"].localeCompare(b["nama produk"]));
  }
  if (sortVal === "name-desc") {
    result.sort((a,b)=> b["nama produk"].localeCompare(a["nama produk"]));
  }
  if (sortVal === "price-asc") {
    result.sort((a,b)=> a.harga - b.harga);
  }
  if (sortVal === "price-desc") {
    result.sort((a,b)=> b.harga - a.harga);
  }

  produkTampil = result;
  currentPage = 1;
  renderPage();
}

/* ======================
   PAGINATION UI
====================== */
function updatePagination(){
  const totalPage = Math.ceil(produkTampil.length / LIMIT);
  document.getElementById("pageInfo").innerText =
    `Halaman ${currentPage} dari ${totalPage}`;

  document.getElementById("prevBtn").disabled = currentPage === 1;
  document.getElementById("nextBtn").disabled = currentPage === totalPage;
}

document.getElementById("prevBtn").onclick = () => {
  if (currentPage > 1) {
    currentPage--;
    renderPage();
    window.scrollTo(0,0);
  }
};

document.getElementById("nextBtn").onclick = () => {
  const totalPage = Math.ceil(produkTampil.length / LIMIT);
  if (currentPage < totalPage) {
    currentPage++;
    renderPage();
    window.scrollTo(0,0);
  }
};

/* ======================
   GALERI
====================== */
function openGallery(el){
  const fotos = JSON.parse(decodeURIComponent(el.dataset.foto || "[]"));
  if (!fotos.length) return;

  const modal = document.getElementById("galleryModal");
  const mainImg = document.getElementById("galleryMain");
  const thumbs = document.getElementById("galleryThumbs");

  modal.classList.add("show");
  mainImg.src = fotos[0];
  thumbs.innerHTML = "";

  fotos.forEach((url, i) => {
    const img = document.createElement("img");
    img.src = url;
    img.className = "gallery-thumb" + (i === 0 ? " active" : "");
    img.onclick = () => {
      mainImg.src = url;
      document.querySelectorAll(".gallery-thumb")
        .forEach(t => t.classList.remove("active"));
      img.classList.add("active");
    };
    thumbs.appendChild(img);
  });
}

function closeGallery(){
  document.getElementById("galleryModal").classList.remove("show");
}

/* ======================
   CART + TOAST
====================== */
function addToCart(e, data){
  e.stopPropagation();

  const item = JSON.parse(decodeURIComponent(data));
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  const index = cart.findIndex(c => c.sku === item.sku);


  if (index !== -1) {
    cart[index].qty += 1;
  } else {
cart.push({
  name: item.name,
  price: item.price,
  image: item.image,
  sku: item.sku,
  qty: 1
});


  }

  localStorage.setItem("cart", JSON.stringify(cart));
  if (typeof updateCartBadge === "function") {
  updateCartBadge();
}
  showToast("Produk ditambahkan ke keranjang");
}

function showToast(text){
  const toast = document.getElementById("toast");
  if (!toast) return;
  toast.innerText = text;
  toast.classList.add("show");
  setTimeout(()=> toast.classList.remove("show"), 2000);
}
