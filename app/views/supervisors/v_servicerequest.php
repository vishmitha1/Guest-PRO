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
        <input type="text" id="searchInput" placeholder="Search by Room ID...">
        <button onclick="searchRequests()">Search</button>
    </div>

    <table id="serviceRequestsTable">
            <thead>
                <tr>
                    <th>Service Request ID</th>
                    <th>Service Type</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SR001</td>
                    <td>Service Type A</td>
                    <td>Normal</td>
                    <td><button class="pending" onclick="toggleStatus(this)">Pending</button></td>
                    <td>
                        <button onclick="openCancelModal('SR001')">Cancel</button>
                    </td>
                </tr>
                <tr>
                    <td>SR002</td>
                    <td>Service Type B</td>
                    <td>Priority</td>
                    <td><button class="completed" onclick="toggleStatus(this)">Completed</button></td>
                    <td>
                        <button onclick="openCancelModal('SR002')">Cancel</button>
                    </td>
                </tr>
                <!-- More rows here -->
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
        function toggleStatus(button) {
            if (button.classList.contains("pending")) {
                button.classList.remove("pending");
                button.classList.add("completed");
                button.textContent = "Completed";
            } else {
                button.classList.remove("completed");
                button.classList.add("pending");
                button.textContent = "Pending";
            }
        }

        function openCancelModal(requestId) {
            var modal = document.getElementById("cancelModal");
            modal.style.display = "block";
            // Set a custom attribute to store the requestId
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
                closeCancelModal();
            } else {
                alert("Please enter a reason for cancellation.");
            }
        }
    </script>