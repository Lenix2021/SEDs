let sidebar = document.getElementById("menu-icon");

sidebar.addEventListener("click", ()=>{
   let side=document.getElementById("menu-sidebar")
   side.style.visibility="visible"
})

let close_sidebar=document.getElementById("close-menu")
close_sidebar.addEventListener("click",()=>{
   let side=document.getElementById("menu-sidebar")
   side.style.visibility="hidden"
})