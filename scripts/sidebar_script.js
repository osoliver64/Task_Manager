

let sidebar = document.getElementById("sidebar");
let colapseMenuIcon = document.getElementById("colapseMenuIcon");
let expandMenuIcon = document.getElementById("expandMenuIcon");
let bodies = document.getElementsByClassName("innerSiteBody");

// Event listener for when user clicks the icon to collapse the side bar menu
let colapseMenuIconListener = colapseMenuIcon.addEventListener("click", function() {
    
    // Hide side bar
    sidebar.classList.toggle("hidden");
    // Unhide expand side bar icon
    expandMenuIcon.classList.toggle("hidden");
    // Toggle class of body to change css when task bar is closed
    for (let body of bodies) {
        body.classList.toggle("taskbarOpen");
    }
});


// Event listener for when user clicks the icon to expand the side bar menu
let expandMenuIconListener = expandMenuIcon.addEventListener("click", function() {

    // Unhide the side bar
    sidebar.classList.toggle("hidden");
    // Hide the expand side bar icon
    expandMenuIcon.classList.toggle("hidden");
    // Toggle class of body to change css when task bar is open
    for (let body of bodies) {
        body.classList.toggle("taskbarOpen");
    }
})


const mediaQuery = window.matchMedia("(max-width: 750px)");

// Change 
function handleMediaQueryChange(event) {
    if (event.matches) {
        // Screen size is 750px or smaller
        // Hide side bar
        sidebar.classList.add("hidden");
        // Unhide expand side bar icon
        expandMenuIcon.classList.remove("hidden");
        // Toggle class of body to change css when task bar is closed
        for (let body of bodies) {
            body.classList.add("taskbarClosed");
            body.classList.remove("taskbarOpen");
        }
    } else {
        // Screen size is larger than 750px
        // Show side bar
        sidebar.classList.remove("hidden");
        // Hide expand side bar icon
        expandMenuIcon.classList.add("hidden");
        // Toggle class of body to change css when task bar is open
        for (let body of bodies) {
            body.classList.add("taskbarOpen");
            body.classList.remove("taskbarClosed");
        }
    }
}

// Event listener for changes in screen size
mediaQuery.addEventListener("change", handleMediaQueryChange);

// Initial screen size check
handleMediaQueryChange(mediaQuery);

