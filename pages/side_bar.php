<?php 
    // session_start();

    

?>


<!-- Side bar for navigating for when user in logged into site -->

<!-- 'Button' to expand side bar (only visable when side bar is colapsed) -->
<a><img id="expandMenuIcon" class="hidden" src="../images/expand_menu.png"></a>

    <div id="sidebar">
        <!-- Heading container -->
        <div id="sidebarHeading">
            <!-- Heading -->
            <h1>Task Manager</h1>
            <!-- 'Button' to colapse side bar -->
            <a><img id="colapseMenuIcon" src="../images/collapse_menu.png"></a>
        </div>
        <!-- Navigation links -->
        <nav>
            <a class="navLink" href="index.php">Dashboard</a>
            <br>
            <a class="navLink" href="highPriority.php">High Priority</a>
            <a class="navLink" href="mediumPriority.php">Medium Priority</a>
            <a class="navLink" href="lowPriority.php">Low Priority</a>
            <br>
            <a class="navLink" href="logout.php">Log Out</a>
        </nav>
    </div>