<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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
                                <button class="completed">Completed</button>
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
            <textarea id="cancelReason" rows="4" cols="50" required></textarea>
            <button class="submit-button" onclick="submitCancellation()">Submit</button>
        </div>
    </div>

    <script>
        function changeStatus(button, requestId, currentStatus) {
            if (currentStatus === 'pending') {
                // Show confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to update the status of this order to 'completed'.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Update status
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
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Error updating status:', error.message);
                            button.classList.remove("completed");
                            button.classList.add("pending");
                            button.textContent = "Pending";
                            alert('Failed to update status. Please try again.');
                        });
                    }
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
    var cancelReason = document.getElementById("cancelReason").value.trim();
    var requestId = document.getElementById("cancelModal").getAttribute("data-requestId");

    // Check if cancellation reason is provided
    if (cancelReason === '') {
        // Display warning if cancellation reason is empty
        Swal.fire({
            title: 'Warning',
            text: 'Cancellation reason is mandatory!',
            icon: 'warning',
            confirmButtonText: 'Ok'
        });
    } else {
        // Proceed with cancellation and show confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to cancel this request.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with cancellation
                const base_url = window.location.origin;
                const apiUrl = `${base_url}/GuestPro/supervisors/cancelServiceRequest/${requestId}/${cancelReason}`;

                fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    location.reload();
                    // You can handle success response here if needed
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
            }
        });
    }
}

    </script>
</body>
</html>
