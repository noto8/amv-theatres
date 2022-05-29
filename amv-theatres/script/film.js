//carousel slides
let slides = document.querySelectorAll('.carousel-slide img');
let datasetDot = 0;
slides[0].style.cursor = "auto";
slides.forEach(slide => {
    slide.addEventListener("mouseup", ()=>{
        //set cursor pointer to all slides
        slides.forEach(el=>{el.style.cursor = "pointer"});
        //set cursor auto to current slide
        slide.style.cursor = "auto";
        //make all dots undelected
        dots.forEach(dot=>{dot.className="dot"});
        //make the current slide dot selected
        document.querySelector('.dot[data-pos="'+slide.dataset.pos+'"]').className = "dot selected";
        //move the slides
        document.getElementById('carouselSlides').style.transform = "translateX("+slide.dataset.pos+"%)";
    });
});

//carousel dots
let dots = document.querySelectorAll('.dot');
dots[0].className = "dot selected";
dots.forEach(dot => {
    dot.addEventListener("mouseup", ()=>{
        //make all dots unselected
        dots.forEach(el=>{el.className="dot";});
        //make the current dot selected
        dot.className = "dot selected";
        //set cursor pointer to all slides
        slides.forEach(el=>{el.style.cursor = "pointer"});
        //set cursor auto to current slide
        document.querySelector('.carousel-slide img[data-pos="'+dot.dataset.pos+'"]').style.cursor = "auto";
        //move the slides
        document.getElementById('carouselSlides').style.transform = "translateX("+dot.dataset.pos+"%)";
    });
});