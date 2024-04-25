<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>



<div class="home">
    <div class="manager-page">
        <div class="add-new-form">
            <div class="add-new-form-header">
                <center>
                    <h2>Send Alerts</h2>
                </center>
                <p>Please fill this form to send alert.</p>
            </div>

            <form action="<?php echo URLROOT; ?>/Managers/sendAlert" method="POST">
                <label for="recipients">Recipients:</label>
                <select id="recipients" name="recipients">
                    <option value="all">All Users</option>
                    <option value="guests">Inhouse Guests</option>

                </select>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" placeholder="Enter the subject" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Enter the message" required></textarea>
                <button type="submit">Send Alert</button>
            </form>

        </div>
    </div>
</div>