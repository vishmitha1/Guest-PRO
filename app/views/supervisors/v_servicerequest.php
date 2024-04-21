<?php require APPROOT . "/views/includes/components/sidenavbar_supervisor.php" ?>

<div class="dashboard">

    <div class="flavours-header">Service Requests</div>

    <div class="filter-options">
        <label for="statusFilter">Filter by Status:</label>
        <select id="statusFilter" onchange="filterRequests()">
            <option value="all">All Requests</option>
            <option value="completed">Completed</option>
            <option value="not-completed">Not Completed</option>
        </select>
    </div>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button>Search</button>
    </div>

    <table id="serviceRequestsTable">
        <thead>
            <tr>
                <th>Service Request ID</th>
                <th>Room Number</th>
                <th>Service Type</th>
                <th>Service Requested</th>
                <th>Additional Details</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['servicerequests'] as $servicerequest): ?>
                <tr>
                    <td><?php echo $servicerequest->request_id; ?></td>
                    <td><?php echo $servicerequest->roomNo; ?></td>
                    <td><?php echo $servicerequest->service_type; ?></td>
                    <td><?php echo $servicerequest->service_requested; ?></td>
                    <td><?php echo $servicerequest->AddDetails; ?></td>
                    <td>
                        <?php if ($servicerequest->status == 'completed'): ?>
                            <button class="completed" disabled>Completed</button>
                        <?php elseif($servicerequest->status == 'pending'): ?>
                            <button class="pending" onclick="changeStatus(this, '<?php echo $servicerequest->request_id; ?>', 'pending')">Pending</button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($servicerequest->status == 'pending'): ?>
                            <button onclick="openCancelModal('<?php echo $servicerequest->request_id; ?>')">Cancel</button>
                        <?php else: ?>
                            <button disabled>Cancel</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="cancelModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCancelModal()">&times;</span>
        <h2>Cancel Request</h2>
        <p>Please enter the reason for cancellation:</p>
        <textarea id="cancelReason" rows="4" cols="50"></textarea>
        <button class="submit-button" onclick="submitCancellation()">Submit</button>
    </div>
</div>

<script>
    function changeStatus(button, requestId, currentStatus) {
        if (currentStatus === 'pending') {
            button.classList.remove("pending");
            button.classList.add("completed");
            button.textContent = "Completed";

            const apiUrl = `/GuestPro/supervisors/changeServiceRequestStatus/${requestId}`;

            fetch(apiUrl, {
                method: 'POST',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update status');
                }
                console.log('Status updated to completed');
            })
            .catch(error => {
                console.error('Error updating status:', error.message);
                button.classList.remove("completed");
                button.classList.add("pending");
                button.textContent = "Pending";
                alert('Failed to update status. Please try again.');
            });
        }
    }

    function openCancelModal(requestId) {
        var modal = document.getElementById("cancelModal");
        modal.style.display = "block";
        modal.setAttribute("data-requestId", requestId);
    }

    function closeCancelModal() {
        var modal = document.getElementById("cancelModal");
        modal.style.display = "none";
    }

    function submitCancellation() {
        var modal = document.getElementById("cancelModal");
        var requestId = modal.getAttribute("data-requestId");
        var reason = document.getElementById("cancelReason").value;
        if (reason.trim() !== "") {
            console.log("Request ID: " + requestId + ", Reason: " + reason);

            // Construct the API URL
            const base_url = window.location.origin;
            const apiUrl = `${base_url}/GuestPro/supervisors/cancelServiceRequest/${requestId}/${reason}`;

            // Fetch API call to submit cancellation
            fetch(apiUrl, {
                method: 'POST',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to submit cancellation');
                }
                console.log('Cancellation submitted successfully');
                const cancelButton = document.querySelector(`button[data-request-id="${requestId}"]`);
                const row = cancelButton.closest('tr');
                row.remove();
                alert('Cancellation request submitted successfully.');
            })
            .catch(error => {
                console.error('Error submitting cancellation:', error.message);
                
            });

            closeCancelModal();
        } else {
            alert("Please enter a reason for cancellation.");
        }
    }
</script>
