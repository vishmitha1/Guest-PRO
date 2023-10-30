<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="dashboard">
        

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <!-- Topic for Service Requests -->
        <h2>Service Requests</h2>
        
        <!-- Form for sending a message -->
        <form action="send_message.php"  class="message-form">
            <textarea name="message" class="message-input" placeholder="Type your message..." rows="4"></textarea>
            <button type="submit" class="send-button">Send</button>
        </form>
    </div>

