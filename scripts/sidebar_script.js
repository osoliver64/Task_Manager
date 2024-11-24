

let sidebar = document.getElementById("sidebar");
let colapseMenuIcon = document.getElementById("colapseMenuIcon");
let expandMenuIcon = document.getElementById("expandMenuIcon");
let bodies = document.getElementsByClassName("innerSiteBody");


let colapseMenuIconListener = colapseMenuIcon.addEventListener("click", function() {
    
    sidebar.classList.toggle("hidden");
    expandMenuIcon.classList.toggle("hidden");
    for (let body of bodies) {
        body.classList.toggle("taskbarOpen");
    }



});

let expandMenuIconListener = expandMenuIcon.addEventListener("click", function() {

    sidebar.classList.toggle("hidden");
    expandMenuIcon.classList.toggle("hidden");
    for (let body of bodies) {
        body.classList.toggle("taskbarOpen");
    }
})