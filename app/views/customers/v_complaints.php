
<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<body>

<div class="complains">


    <div class="container">
        <h2>Submit a Complaint</h2>
        <form id="complaintForm">
            <div class="form-group">
                <label for="complaint">Complaint:</label>
                <textarea id="complaint" name="complaint" placeholder="Enter your complaint..." required></textarea>
            </div>
            <div class="satisfaction">
                <label for="satisfaction-very-good">
                    <input type="radio" id="satisfaction-very-good" name="satisfaction" value="very-good">
                    <span>😀 Very Good</span>
                </label>
                <label for="satisfaction-good">
                    <input type="radio" id="satisfaction-good" name="satisfaction" value="good">
                    <span>😊 Good</span>
                </label>
                <label for="satisfaction-normal">
                    <input type="radio" id="satisfaction-normal" name="satisfaction" value="normal">
                    <span>😐 Normal</span>
                </label>
                <label for="satisfaction-bad">
                    <input type="radio" id="satisfaction-bad" name="satisfaction" value="bad">
                    <span>😞 Bad</span>
                </label>
                <label for="satisfaction-very-bad">
                    <input type="radio" id="satisfaction-very-bad" name="satisfaction" value="very-bad">
                    <span>😡 Very Bad</span>
                </label>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("complaintForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        // You can add your JavaScript code here to handle the form submission, like sending data to your server
        // For demonstration purposes, let's just log the data to the console
        const formData = new FormData(event.target);
        const complaint = formData.get("complaint");
        const satisfaction = formData.get("satisfaction");
        console.log("Complaint:", complaint);
        console.log("Satisfaction:", satisfaction);
        // You can further process the data or send it to your server via AJAX
        // For now, we'll just show a simple alert
        alert("Complaint submitted successfully!");
    });
</script>
</body>