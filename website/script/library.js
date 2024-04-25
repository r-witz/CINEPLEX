const header = document.querySelector('header');
const content = document.querySelector('.content');
const film_carousel = document.getElementById('film-carousel');
const footer = document.querySelector('footer');
const returnButton = document.querySelector('.return-button');

function hideOtherElements() {
    header.style.display = 'none';
    film_carousel.style.display = 'none';
    footer.style.display = 'none';
}

function showOtherElements() {
    header.style.display = 'flex';
    film_carousel.style.display = 'flex';
    footer.style.display = 'flex';
}

document.addEventListener("DOMContentLoaded", function() {
    const playButtons = document.querySelectorAll('.play-button');

    playButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filmContainer = button.closest('.film-container');
            const image = filmContainer.querySelector('img');
            const imageUrl = image.getAttribute('src');
            const newUrl = imageUrl.replace('/img/films/large/', '/video/trailers/').replace('.webp', '.mp4');
            
            const video = document.createElement('video');
            const source = document.createElement('source');
            source.setAttribute('src', newUrl);
            source.setAttribute('type', 'video/mp4');

            returnButton.style.display = 'block';
            
            video.classList.add('main-video');
            
            video.appendChild(source);
            filmContainer.appendChild(video);
            
            video.controls = true;
            video.autoplay = true;
            
            video.addEventListener('loadeddata', function() {
                video.play();
                hideOtherElements();
            });
        });
    });

    returnButton.addEventListener('click', function() {
        const video = document.querySelector('.main-video');
        video.remove();
        returnButton.style.display = 'none';

        showOtherElements();
    });
});