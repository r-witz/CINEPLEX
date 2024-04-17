document.addEventListener("DOMContentLoaded", function() {
    var searchIcon = document.getElementById("searchIcon");
    var checkbox = document.querySelector(".checkbox");
    var searchInput = document.querySelector(".search_input");
    var cate

    searchIcon.addEventListener("click", function() {
        checkbox.checked = !checkbox.checked;

        if (checkbox.checked) {
            searchInput.style.display = "inline-block";
        } else {
            searchInput.style.display = "none";
        }
    });
});
