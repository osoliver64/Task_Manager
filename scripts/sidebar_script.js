

let sidebar = document.getElementById("sidebar");
let colapseMenuIcon = document.getElementById("colapseMenuIcon");
let expandMenuIcon = document.getElementById("expandMenuIcon");
let indexBody = document.getElementById("indexBody");


let colapseMenuIconListener = colapseMenuIcon.addEventListener("click", function() {
    
    sidebar.classList.toggle("hidden");
    expandMenuIcon.classList.toggle("hidden");

    indexBody.classList.toggle("taskbarOpen");


});

let expandMenuIconListener = expandMenuIcon.addEventListener("click", function() {

    sidebar.classList.toggle("hidden");
    expandMenuIcon.classList.toggle("hidden");
    indexBody.classList.toggle("taskbarOpen");
})