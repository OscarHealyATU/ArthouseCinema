let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(x) {
    showSlides(slideIndex += x);
}
function currentSlide(x) {
    showSlides(slideIndex = x);
}
function showSlides(x) {
    let i;
    let slides = document.getElementsByClassName("slides");
    let dots = document.getElementsByClassName("dots");
    if (x > slides.length) { slideIndex = 1 }
    if (x < 1) { slideIndex = slides.length }

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";

}