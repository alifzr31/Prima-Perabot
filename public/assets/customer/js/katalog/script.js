function goHome(){
  window.location.href = "../index.html";
}

function goCart(){
  if(localStorage.getItem("isLogin") === "true"){
    window.location.href = "../checkout.html";
  }else{
    alert("Silakan login terlebih dahulu");
    window.location.href = "login.html";
  }
}

function toggleProfile(){
  alert("Fitur profile coming soon 😄");
}

function goAllProduct() {
  window.location.href = "allproduk.html";
}
