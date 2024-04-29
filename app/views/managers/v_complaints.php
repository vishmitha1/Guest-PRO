<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="manager-page">

        <h1 style="text-align:left; color: #003366;">Guests Complaints</h1>
        <br></br>

        <form action="<?php echo URLROOT; ?>/Managers/applyComplaintsFilters" method="post">
            <div class="filter-options">
                <div class="filter-box">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">select</option>
                        <?php foreach ($data['complaintstype'] as $complaintstype): ?>
                            <option value="<?php echo $complaintstype->complaint_type; ?>">
                                <?php echo ucfirst($complaintstype->complaint_type); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-box">
                    <label for="date"> Date</label>
                    <div class="date">
                        <input type="date" id="datefilter" name="date">
                    </div>
                </div>

                <div class="filter-box">
                    <form action="<?php echo URLROOT; ?>/Managers/applyComplaintsFilters" method="post">
                        <button type="submit">Apply</button>
                    </form>
                    <form action="<?php echo URLROOT; ?>/Managers/resetComplaintsFilters" method="post">
                        <button type="submit">Reset</button>
                    </form>
                </div>
            </div>
        </form>


        <!-- Display service requests -->
        <div class="view-container">
            <?php foreach ($data['complaints'] as $complaint): ?>
                <div class="complaint-item">
                    <div class="complaint-details">
                        <div class="left-details">
                            <div class="detail">
                                <strong>Complaint ID:</strong>
                                <?php echo $complaint->complaint_id; ?>
                            </div>
                            <div class="detail">
                                <strong>Guest ID:</strong>
                                <?php echo $complaint->guest_id; ?>
                            </div>
                            <div class="detail">
                                <strong>Room Number:</strong>
                                <?php echo $complaint->guest_room_number; ?>
                            </div>
                            <div class="detail">
                                <strong>Complaint Type:</strong>
                                <?php echo ucfirst($complaint->complaint_type); ?>
                            </div>
                        </div>
                        <div class="right-details">
                            <div class="detail">
                                <!-- <strong>Created At:</strong> -->
                                <?php echo ($complaint->created_at); ?>
                            </div>
                            <div class="detail">
                                <strong>Status:</strong>
                                <?php echo ucfirst($complaint->status); ?>
                            </div>
                            <div class="change-status">
                                <form action="<?php echo URLROOT; ?>/Managers/changeComplaintStatus" method="post">
                                    <input type="hidden" name="complaint_id"
                                        value="<?php echo $complaint->complaint_id; ?>">
                                    <select name="new_status">
                                        <option value="pending" <?php echo ($complaint->status === 'pending') ? 'selected' : ''; ?>>
                                            Pending</option>
                                        <option value="in_progress" <?php echo ($complaint->status === 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                                        <option value="resolved" <?php echo ($complaint->status === 'resolved') ? 'selected' : ''; ?>>
                                            Resolved</option>
                                    </select>
                                    <button type="submit">Change Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="complaint-content">
                        <?php echo ucfirst($complaint->complaint_details); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>