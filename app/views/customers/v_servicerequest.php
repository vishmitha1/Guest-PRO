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

        <div class="bill-table-warpper">
            <div class="main-title"> History</div>
            <div class="bill-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Description</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>    
                        <tbody>
                            <tr>
                                <td>2023/04/10</td>
                                <td>10.25am</td>
                                <td>front desk with a request for additional towels.</td>
                                <td>Placed</td>
                                
                            </tr>
                            <tr>
                                <td>2023/06/18</td>
                                <td>10.25am</td>
                                <td>front desk with a request for additional towels.</td>
                                <td>Placed</td>
                                
                            </tr>
                            <tr>
                                <td>2023/04/10</td>
                                <td>10.25pm</td>
                                <td>front desk with a request for additional towels.</td>
                                <td>Placed</td>
                                
                            </tr>
                            
                            
                           
                        </tbody>
                    
                </table>
            </div>
        </div>
    </div>

