searchSubmit = document.getElementById("nav-search-submit");
searchSubmit.addEventListener("click", function(){
    searchInput = document.getElementById("nav-search-input");
    window.location.href = "search.php?q="+encodeURI(searchInput.value);
    // console.log("search.php?q="+encodeURI(searchInput.value));
});