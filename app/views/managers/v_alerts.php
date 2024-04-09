<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>



<div class="home">
    <div class="manager-page">


        <h1>Send Alerts</h1> <!-- Updated title -->

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <!-- Form for sending alerts with class selectors -->
        <form class="alert-form">
            <label for="message">Alert Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Send Alert</button>
        </form>
    </div>
</div>