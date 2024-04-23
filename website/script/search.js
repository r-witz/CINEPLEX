const filmCarousel = document.getElementById("film-carousel");
const images = filmCarousel.getElementsByTagName("img");

images[0].id = "selected";

for (let i = 0; i < images.length; i++) {
    images[i].addEventListener("click", function() {
        const oldSelectedImage = document.getElementById("selected");
        oldSelectedImage.removeAttribute("id");

        this.id = "selected";
    });
}