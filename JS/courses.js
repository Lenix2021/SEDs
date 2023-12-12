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

document.addEventListener("DOMContentLoaded", function() {
   function isInViewport(element) {
       var rect = element.getBoundingClientRect();
       return (
           rect.top >= 0 &&
           rect.left >= 0 &&
           rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
           rect.right <= (window.innerWidth || document.documentElement.clientWidth)
       );
   }

   function handleIntersection(entries, observer) {
       entries.forEach(function(entry) {
           if (entry.isIntersecting) {
               entry.target.classList.add('appear');
               observer.unobserve(entry.target);
           }
       });
   }

   var observer = new IntersectionObserver(handleIntersection, { threshold: 0.5 });

   var programs = document.querySelectorAll('.program1');
   programs.forEach(function(program) {
       observer.observe(program);
   });
   
   var othersContents = document.querySelectorAll('.others1');
   othersContents.forEach(function(othersContent) {
       observer.observe(othersContent);
   });
});
