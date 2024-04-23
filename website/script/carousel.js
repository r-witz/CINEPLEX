document.addEventListener('DOMContentLoaded', function() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    const selectionCircles = document.querySelectorAll('.selection-circle');
    const buyButton = document.querySelector('.buy-button');
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
        intervalId = setInterval(nextImage, 5000);
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

