

let sidebar = document.getElementById("sidebar");
let colapseMenuIcon = document.getElementById("colapseMenuIcon");
let expandMenuIcon = document.getElementById("expandMenuIcon");
let indexBody = document.getElementById("indexBody");
let searchResultBody = document.getElementById("searchResultBody")


let colapseMenuIconListener = colapseMenuIcon.addEventListener("click", function() {
    
    sidebar.classList.toggle("hidden");
    expandMenuIcon.classList.toggle("hidden");
    if (indexBody) {
        indexBody.classList.toggle("taskbarOpen");
    }
    if (searchResultBody) {
        searchResultBody.classList.toggle("taskbarOpen")
    }


});

let expandMenuIconListener = expandMenuIcon.addEventListener("click", function() {

    sidebar.classList.toggle("hidden");
    expandMenuIcon.classList.toggle("hidden");
    if (indexBody) {
        indexBody.classList.toggle("taskbarOpen");
    }
    if (searchResultBody) {
        searchResultBody.classList.toggle("taskbarOpen")
    }
})