document.addEventListener('DOMContentLoaded', function() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    const selectionCircles = document.querySelectorAll('.selection-circle');
    const buyButton = document.querySelector('.buy-button');
    const buyButtonRedirect = document.querySelector('#buy-button-redirect');
    let currentIndex = 0;
    let intervalId;

    function showImage(index) {
        carouselItems.forEach(item => item.style.display = 'none');
        carouselItems[index].style.display = 'block';
        selectionCircles.forEach(circle => circle.classList.remove('selected'));
        selectionCircles[index].classList.add('selected');
    }

    function stopCarousel() {
        clearInterval(intervalId);
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % carouselItems.length;
        showImage(currentIndex);
    }

    function startCarousel() {
        intervalId = setInterval(function() {
            nextImage();
            updateBuyButtonLink();
        }, 5000);
    }
    
    function updateBuyButtonLink() {
        const currentImage = carouselItems[currentIndex];
        if (currentImage.alt === "Forrest Gump") {
            buyButtonRedirect.setAttribute('href', 'search.php?search=forrest');
        } else if (currentImage.alt === "The Godfather") {
            buyButtonRedirect.setAttribute('href', 'search.php?search=godfather');
        } else if (currentImage.alt === "Fight Club") {
            buyButtonRedirect.setAttribute('href', 'search.php?search=fight');
        } else if (currentImage.alt === "Inception") {
            buyButtonRedirect.setAttribute('href', 'search.php?search=inception');
        }
    }
    

    selectionCircles.forEach((circle, index) => {
        circle.addEventListener('click', function() {
            currentIndex = index;
            showImage(currentIndex);
        });
    });

    buyButton.addEventListener('click', stopCarousel);

    showImage(currentIndex);
    startCarousel();
});

