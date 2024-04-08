<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="manager-page">
        <h1>Guests Complaints</h1>

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
                                <?php echo $complaint->complaint_type; ?>
                            </div>
                        </div>
                        <div class="right-details">
                            <div class="detail">
                                <strong>Status:</strong>
                                <?php echo $complaint->status; ?>
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
                        <?php echo $complaint->complaint_details; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>