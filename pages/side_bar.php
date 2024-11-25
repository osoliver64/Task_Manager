
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
            <!-- Link to dashboard page -->
            <a class="navLink" href="index.php">Dashboard</a>
            <br>
            <!-- Link to high priority tasks page -->
            <a class="navLink" href="highPriority.php">High Priority</a>
            <!-- Link to medium priority tasks page -->
            <a class="navLink" href="mediumPriority.php">Medium Priority</a>
            <!-- Link to low priority tasks page -->
            <a class="navLink" href="lowPriority.php">Low Priority</a>
            <br>
            <!-- Link to log user out of site. Ends the session and redirects user to log in  -->
            <a class="navLink" href="../private/functions/logout.php">Log Out</a>
        </nav>
    </div>