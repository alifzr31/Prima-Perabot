let katalogData = [];

fetch("../data/katalog.json")
  .then(res => res.json())
  .then(data => {
    katalogData = data;
    renderKategori(data);
     renderBrand(data);
  })
  .catch(err => console.error(err));

function renderKategori(data) {
  const container = document.getElementById("kategoriGroupList");
  container.innerHTML = "";

  /* =========================
     GROUP BY KATEGORI
     ========================= */
  const kategoriMap = {};

  data.forEach(item => {
    const kategori = (item.kategori || "Lainnya").trim();

    if (!kategoriMap[kategori]) {
      kategoriMap[kategori] = 0;
    }
    kategoriMap[kategori]++;
  });

  /* =========================
     RENDER LIST
     ========================= */
  Object.keys(kategoriMap)
  .sort()
  .forEach(kategori => {

    const firstLetter = kategori.charAt(0).toUpperCase();

      const total = kategoriMap[kategori];

      const item = document.createElement("a");
      item.className = "list-item";
      item.href = `produk.html?kategori=${encodeURIComponent(kategori)}`;

      item.innerHTML = `
        <div class="item-left">
          <div class="item-icon blue">
            <span class="material-icons">category</span>
          </div>
          <div class="item-text">
            <h3>
              ${kategori}
              <span class="badge-count">${total}</span>
            </h3>
          </div>
        </div>
        <span class="material-icons item-right">chevron_right</span>
      `;
      item.id = "kategori-" + firstLetter;
      container.appendChild(item);
    });
}

/*FILTER KATEGORI*/ 

function filterKategori() {
  const keyword = document
    .getElementById("kategoriSearchInput")
    .value
    .toLowerCase()
    .trim();

  if (!keyword) {
    renderKategori(katalogData);
    return;
  }

  const filtered = katalogData.filter(item =>
    item.kategori &&
    item.kategori.toLowerCase().includes(keyword)
  );

  renderKategori(filtered);
}

function filterBrand() {
  const keyword = document
    .getElementById("brandSearchInput")
    .value
    .toLowerCase()
    .trim();

  if (!keyword) {
    renderBrand(katalogData);
    return;
  }

  const filtered = katalogData.filter(item =>
    item.brand &&
    item.brand.toLowerCase().includes(keyword)
  );

  renderBrand(filtered);
}


/* =========================
     RENDER BRAND
========================= */
function renderBrand(data) {
  const container = document.getElementById("brandList");
  if (!container) return;

  container.innerHTML = "";

  const brandMap = {};

  data.forEach(item => {
    const brand = (item.brand || "Lainnya").trim();

    if (!brandMap[brand]) {
      brandMap[brand] = 0;
    }
    brandMap[brand]++;
  });

  Object.keys(brandMap)
    .sort()
    .forEach(brand => {
      const total = brandMap[brand];

      const item = document.createElement("a");
      item.className = "list-item";
      item.href = `produk.html?brand=${encodeURIComponent(brand)}`;

      item.innerHTML = `
        <div class="item-left">
          <div class="item-icon blue">
            <span class="material-icons">store</span>
          </div>
          <div class="item-text">
            <h3>
              ${brand}
              <span class="badge-count">${total}</span>
            </h3>
          </div>
        </div>
        <span class="material-icons item-right">chevron_right</span>
      `;

      container.appendChild(item);
    });
}


/*SETIAP KEMBALI KE HALAMAN KATALOG, INPUT HARUS KOSONG*/ 
window.addEventListener("pageshow", () => {
  const input = document.getElementById("kategoriSearchInput");
  if (input) {
    input.value = "";
    renderKategori(katalogData);
  }
});

/*switch katalog & Brand*/
function switchTab(type){

  const kategori = document.getElementById("kategoriSection");
  const brand = document.getElementById("brandSection");

  const buttons = document.querySelectorAll(".tab-btn");
  buttons.forEach(btn => btn.classList.remove("active"));

  // SIMPAN TAB KE LOCALSTORAGE
  localStorage.setItem("activeTab", type);

  if(type === "kategori"){
    kategori.style.display = "block";
    brand.style.display = "none";
    buttons[0].classList.add("active");
    renderKategori(katalogData);
  } else {
    kategori.style.display = "none";
    brand.style.display = "block";
    buttons[1].classList.add("active");
    renderBrand(katalogData);
  }
}

// =============================
// LOAD TAB TERAKHIR SAAT PAGE LOAD
// =============================
window.addEventListener("DOMContentLoaded", () => {

  const savedTab = localStorage.getItem("activeTab");

  if(savedTab){
    switchTab(savedTab);
  } else {
    switchTab("kategori"); // default
  }

});
// =============================
// RESET SEARCH SAAT KEMBALI KE HALAMAN
// =============================
window.addEventListener("pageshow", () => {

  // Reset search kategori
  const kategoriInput = document.getElementById("kategoriSearchInput");
  if (kategoriInput) {
    kategoriInput.value = "";
    renderKategori(katalogData);
  }

  // Reset search brand
  const brandInput = document.getElementById("brandSearchInput");
  if (brandInput) {
    brandInput.value = "";
    renderBrand(katalogData);
  }

});


