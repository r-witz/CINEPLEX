function hideOtherElements() {
    document.getElementById('film-carousel').style.display = 'none';

    document.querySelector('header').style.display = 'none';

    document.querySelector('footer').style.display = 'none';

    document.querySelector('.content').style.display = 'none';

    const filmContainer = video.closest('.film-container');
    filmContainer.style.display = 'none';
    document.body.appendChild(video);

    const returnButton = filmContainer.querySelector('button');
    returnButton.style.display = 'block';
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
            
            video.classList.add('main-video');
            
            video.appendChild(source);
            filmContainer.replaceChild(video, image);
            
            video.controls = true;
            video.autoplay = true;
            
            video.addEventListener('loadeddata', function() {
                video.play();
                hideOtherElements();
            });
        });
    });

const returnButtons = document.querySelectorAll('.return-button');
    returnButtons.forEach(returnButton => {
        returnButton.addEventListener('click', function() {
            const video = document.querySelector('.main-video');
            const filmContainer = video.parentNode;
            filmContainer.style.display = 'block';
            filmContainer.replaceChild(document.createElement('img'), video);
            returnButton.style.display = 'none';

            // Afficher à nouveau les éléments masqués
            document.querySelector('header').style.display = 'block';
            document.querySelector('footer').style.display = 'block';
            document.getElementById('film-carousel').style.display = 'block';
            document.getElementsByClassName('content')[0].style.display = 'block';
        });
    });
});
