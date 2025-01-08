let sidebar = document.getElementById("menu-icon");
let side = document.getElementById("menu-sidebar");

sidebar.addEventListener("click", () => {
  side.classList.add("shown");
});

let close_sidebar = document.getElementById("close-menu");
close_sidebar.addEventListener("click", () => {
  side.classList.remove("shown");
});

//  popup message to chose the form you are applying for
var franko = document.getElementById("franko");
var close_popup = document.getElementById("close-popup");

franko.addEventListener("click", handlePopup);
close_popup.addEventListener("click", closePopup);

// Optionally handle touchstart for better mobile support
franko.addEventListener("touchstart", handlePopup);
close_popup.addEventListener("touchstart", closePopup);

function handlePopup() {
  const pop = document.getElementById("popup");
  pop.style.visibility = "visible";
  const overlay = document.createElement("div");
  overlay.classList.add("overlay");
  document.body.appendChild(overlay);
  overlay.style.pointerEvents = "auto";
}

function closePopup() {
  const pop = document.getElementById("popup");
  pop.style.visibility = "hidden";
  const over = document.querySelector(".overlay");
  if (over) document.body.removeChild(over);
}
