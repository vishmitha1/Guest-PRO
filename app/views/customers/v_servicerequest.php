<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="dashboard">
        

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <!-- Topic for Service Requests -->
        <h2>Service Requests</h2>
        
        <!-- Form for sending a message -->
        <form action="<?php echo URLROOT;?>/Customers/servicerequest" method="POST" >
            <textarea name="message" class="message-input" placeholder="Type your message..." rows="4"></textarea>
            <button type="submit" class="send-button">Send</button>
        </form>

        <div class="foodorder-table-warpper">
            <div class="main-title">Service Requests</div>
            <div class="foodorder-table-container">
                <table>
                    <thead>
                        <tr>
                            <th hidden >orderid</th>
                            
                            <th>Date</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>    
                        <tbody>
                            <?php
                                foreach ($data as $item) {
                                    echo "
                                    <tr>
                                        <td hidden>{$item->request_id}</td>
                                        
                                        <td>{$item->date}</td>
                                        <td>{$item->message}</td>
                                        <td>{$item->status}</td>
                                        ";
                                    if($item->status =="Completed" ){
                                        echo "<td><button type='submit'  class='light-blue'>Complete</button></td>
                                        </tr>";
                                    }
                                    else{
                                        echo "<td> <a href='updateservicerequest/{$item->request_id}'><button type='submit' class='light-green'>Edit</button></a>
                                                   <a href='deleteservicerequest/{$item->request_id}'><button type='submit' class='light-perple'>Delete</button></a> </td>
                                        </tr>";
                                    }
                                }
                            ?>
                            
                            
                        </tbody>
                       
                    
                </table>
            </div>
        </div>
    </div>

