document.addEventListener("DOMContentLoaded", function() {
    var searchIcon = document.getElementById("searchIcon");
    var checkbox = document.querySelector(".checkbox");
    var searchInput = document.querySelector(".search_input");

    searchIcon.addEventListener("click", function() {
        checkbox.checked = !checkbox.checked;

        if (checkbox.checked) {
            searchInput.style.display = "inline-block";
            setTimeout(function() {
                searchInput.style.width = "250px";
            }, 0);
        } else {
            searchInput.style.width = "0";
            setTimeout(function() {
                searchInput.style.display = "none";
            }, 500);
        }
    });
});
