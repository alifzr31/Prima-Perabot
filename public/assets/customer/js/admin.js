const DB_KEY = "db_katalog_v3";
let editIndex = null;

// LOAD JSON → LocalStorage
async function loadDB() {
  let data = localStorage.getItem(DB_KEY);

  if (!data) {
    const res = await fetch("/data/katalog_web_v3.json");
    const json = await res.json();
    localStorage.setItem(DB_KEY, JSON.stringify(json));
    return json;
  }
  return JSON.parse(data);
}

// INIT
document.addEventListener("DOMContentLoaded", async () => {
  await loadDB();
  renderList();
});

// RENDER TABLE
async function renderList() {
  const db = await loadDB();
  const tbody = document.getElementById("produkList");
  tbody.innerHTML = "";

  db.forEach((p, i) => {
    tbody.innerHTML += `
      <tr>
        <td>${p["sku induk"]}</td>
        <td>${p["nama produk"]}</td>
        <td>${p.harga}</td>
        <td>${p.kategori}</td>
        <td class="action">
          <button onclick="editProduk(${i})">Edit</button>
          <button onclick="hapusProduk(${i})">Hapus</button>
        </td>
      </tr>
    `;
  });
}

// CREATE / UPDATE
async function simpanProduk() {
  const db = await loadDB();

  const produk = {
    "sku induk": sku.value.trim(),
    "nama produk": nama.value.trim(),
    "harga": Number(harga.value),
    "kategori": kategori.value.trim(),
    "foto": foto.value
      .split("\n")
      .map(f => f.trim())
      .filter(f => f)
  };

  if (!produk["sku induk"] || !produk["nama produk"]) {
    return alert("SKU & Nama wajib diisi");
  }

  if (editIndex === null) {
    db.push(produk);
  } else {
    db[editIndex] = produk;
  }

  localStorage.setItem(DB_KEY, JSON.stringify(db));
  resetForm();
  renderList();
}

// READ → FORM
async function editProduk(index) {
  const db = await loadDB();
  const p = db[index];

  sku.value = p["sku induk"];
  nama.value = p["nama produk"];
  harga.value = p.harga;
  kategori.value = p.kategori;
  foto.value = p.foto.join("\n");

  editIndex = index;
  document.getElementById("formTitle").innerText = "Edit Produk";
}

// DELETE
async function hapusProduk(index) {
  if (!confirm("Hapus produk ini?")) return;

  const db = await loadDB();
  db.splice(index, 1);
  localStorage.setItem(DB_KEY, JSON.stringify(db));
  renderList();
}

// RESET FORM
function resetForm() {
  sku.value = "";
  nama.value = "";
  harga.value = "";
  kategori.value = "";
  foto.value = "";
  editIndex = null;
  document.getElementById("formTitle").innerText = "Tambah Produk";
}

// EXPORT JSON
function exportJSON() {
  const data = localStorage.getItem(DB_KEY);
  const blob = new Blob([data], { type: "application/json" });
  const a = document.createElement("a");
  a.href = URL.createObjectURL(blob);
  a.download = "katalog_web_v3.json";
  a.click();
}
