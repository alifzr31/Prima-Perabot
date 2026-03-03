fetch("data/katalog.json")
  .then(res => res.json())
  .then(data => {

    const targetProduk = [
      { 
        nama: "Kursi Baso Rotan Plastik Tabitha", 
        sku: "CoklatMuda" 
      },
      { 
        nama: "Storage Box Multifungsi Box Penyimpanan Container 52 L Transparan", 
        sku: "52-Clear" 
      }
    ];

    const bestSeller = data.filter(p => {

      return targetProduk.some(t => 
        p["nama produk"] &&
        p.sku &&
        p["nama produk"].toLowerCase().trim() === t.nama.toLowerCase().trim() &&
        p.sku.toLowerCase().trim() === t.sku.toLowerCase().trim()
      );

    });

    renderBestSeller(bestSeller);
    startCountdown();
  });



function renderBestSeller(list){
  const container = document.getElementById("produkTerlaris");
  container.innerHTML = "";

  list.forEach(p => {

    const stokRandom = Math.floor(Math.random() * 15) + 3;

    const fotos = [
      p.main_image,
      p.image_2,
      p.image_3,
      p.image_4,
      p.image_5,
      p.image_6
    ].filter(Boolean);

    container.innerHTML += `
      <div class="produk-card best-wow"
           data-product="${encodeURIComponent(JSON.stringify(p))}"
           onclick="openDetail(JSON.parse(decodeURIComponent(this.dataset.product)))">

        <div class="best-badge">🔥 BEST SELLER</div>

        <img src="${fotos[0] || 'images/no-image.png'}">

        <div class="produk-info">

          <h3>${p["nama produk"]}</h3>

          ${p.sku ? `<div class="best-sku">SKU: ${p.sku}</div>` : ""}

          <div class="price-grosir">
            Rp ${Number(p.harga).toLocaleString("id-ID")}
          </div>

          <div class="stok-warning">
            ⚡ Sisa ${stokRandom} pcs lagi!
          </div>

          <div class="countdown" data-time="600">
            ⏳ Promo berakhir dalam 10:00
          </div>

          <div class="btn-group">
            <button class="btn-beli"
  onclick="event.stopPropagation(); addBestToCart('${encodeURIComponent(JSON.stringify({
    name: p["nama produk"],
    price: p.harga,
    image: fotos[0] || '',
    sku: p.sku
  }))}')">
  BELI SEKARANG
</button>

          </div>

        </div>
      </div>
    `;
  });
}

function startCountdown(){
  document.querySelectorAll(".countdown").forEach(el=>{
    let time = parseInt(el.dataset.time);

    setInterval(()=>{
      if(time <= 0) return;

      time--;
      let minutes = Math.floor(time / 60);
      let seconds = time % 60;

      el.innerHTML = `⏳ Promo berakhir dalam ${minutes}:${seconds < 10 ? "0"+seconds : seconds}`;
    },1000);
  });
}

startCountdown();
