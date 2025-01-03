let words=document.querySelectorAll(".word")
words.forEach((word)=>{
    let letters=word.textContent.split("");
    word.textContent="";
    letters.forEach((letter)=>{
        let span = document.createElement("span")
        span.textContent=letter
        span.className="letter"
        word.append(span);
    });
});

let currentwordindex =0;
let maxwordsindex = words.length -1;
words[currentwordindex].style.opacity="1";


 let changetext = () =>{
    let currentword= words[currentwordindex];
    let nextword = currentwordindex=== maxwordsindex ? words[0] : words[currentwordindex + 1];

    Array.from(currentword.children).forEach((letter,i)=>{
        setTimeout(()=>{
            letter.className="letter out"

        },i*80);
    });
    nextword.style.opacity="1";

    Array.from(nextword.children).forEach((letter,i)=>{
        letter.className="letter behind";
        setTimeout(() => {
            letter.className="letter in"
        },340 + i * 80);
    });
    currentwordindex=currentwordindex === maxwordsindex ? 0 : currentwordindex + 1;
}
 changetext()
 setInterval(changetext,6000)
 
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

//  popup message to chose the form you are applying for 
var franko=document.getElementById("franko");
var close_popup=document.getElementById("close-popup")

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
