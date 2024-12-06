document.addEventListener("DOMContentLoaded", function() {
    // Add a class to each box to trigger the transition
    document.querySelectorAll('.box11').forEach(function(box, index) {
        box.classList.add('appear');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Function to check if an element is in the viewport
    function isInViewport(element) {
        var rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Function to handle the intersection observer callback
    function handleIntersection(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
                observer.unobserve(entry.target); // Remove observation once the element is in view
            }
        });
    }

    // Create an intersection observer
    var observer = new IntersectionObserver(handleIntersection, { threshold: 0.5 });
    

    // Get all elements with class "offer1" and observe them
    var offers = document.querySelectorAll('.offer1');
    offers.forEach(function(offer) {
        observer.observe(offer);
    });
});

var franko=document.getElementById("franko");
var close_popup=document.getElementById("close-popup")

franko.addEventListener("click",()=>{
    var pop= document.getElementById("popup");
    pop.style.visibility="visible";
    pop.style.transition="2s";
   let overlay=document.createElement("div");
   overlay.classList.add("overlay");
   document.body.appendChild(overlay)
   overlay.style.pointerEvents = "auto";
})

close_popup.addEventListener("click",()=>{
    var pop=document.getElementById("popup");
    pop.style.visibility="hidden"
    const over=document.querySelector(".overlay")
    document.querySelector("body").removeChild(over)
})
