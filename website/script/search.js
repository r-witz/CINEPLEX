const filmCarousel = document.getElementById("film-carousel");
const images = filmCarousel.getElementsByTagName("img");

images[0].id = "selected";

for (let i = 0; i < images.length; i++) {
    images[i].addEventListener("click", function() {
        const oldSelectedImage = document.getElementById("selected");
        oldSelectedImage.removeAttribute("id");

        this.id = "selected";
        updateFilmInfos();
        moveCarousel();
    });
}

const getSelectedImagePosition = () => {
    const selectedImage = document.getElementById("selected");
    const selectedImagePosition = Array.from(images).indexOf(selectedImage);

    return selectedImagePosition;
};

const updateFilmInfos = () => {
    const selectedImagePosition = getSelectedImagePosition();
    const filmContainer = document.querySelector("#container");

    filmContainer.style.left = `-${selectedImagePosition * 100}vw`;
};

const moveCarousel = () => {
    const selectedImagePosition = getSelectedImagePosition();
    const filmContainer = document.getElementById("film-carousel");

    const containerWidth = filmContainer.offsetWidth;
    const imageWidth = images[0].offsetWidth;
    const scrollPosition = ((selectedImagePosition + 1) * (imageWidth + 48)) - (containerWidth / 2);

    console.log(selectedImagePosition, containerWidth, imageWidth, scrollPosition);

    filmContainer.scrollLeft = scrollPosition;
};