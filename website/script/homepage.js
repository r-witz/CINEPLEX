document.addEventListener("DOMContentLoaded", function() {
    var scrollDownArrow1 = document.getElementById("scroll-down-arrow1");
    var presentationDiv = document.getElementById("presentation");

    scrollDownArrow1.addEventListener("click", function() {
        var presentationDivPosition = presentationDiv.offsetTop;

        window.scrollTo({
            top: presentationDivPosition,
            behavior: 'smooth'
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var scrollDownArrow2 = document.getElementById("scroll-down-arrow2");
    var cinema_roomDiv = document.getElementById("cinema_room");

    scrollDownArrow2.addEventListener("click", function() {
        var cinema_roomDivPosition = cinema_roomDiv.offsetTop;

        window.scrollTo({
            top: cinema_roomDivPosition,
            behavior: 'smooth'
        });
    });
});