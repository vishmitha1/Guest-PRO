<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="manager-page">
        <h1>Guests Complaints</h1>

        <!-- Display service requests -->
        <div class="view-container">
            <?php foreach ($data['complaints'] as $complaint): ?>
                <div class="request-item">
                    <div class="request-details">


                        <tr>
                            <th>Complaint Id</th>
                            <th>Guest Id</th>
                            <th>Room Number</th>
                            <th>Complaint Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>


                        <tr>
                            <td>
                                <?php echo $complaint->complaint_id; ?>
                            </td>
                            <td>
                                <?php echo $complaint->guest_id; ?>
                            </td>
                            <td>
                                <?php echo $complaint->guest_room_number; ?>
                            </td>
                            <td>
                                <?php echo $complaint->complaint_type; ?>
                            </td>
                            <td>
                                <?php echo $complaint->status; ?>
                            </td>
                            <td>
                                <?php echo $complaint->created_at; ?>
                            </td>
                        </tr>
                        <div class="complaints">
                            <?php echo $complaint->complaint_details; ?>
                        </div>

                    </div>


                    <div class="request-actions">
                        <form action="<?php echo URLROOT; ?>/Managers/changeComplaintStatus" method="post">
                            <input type="hidden" name="complaint_id" value="<?php echo $complaint->complaint_id; ?>">
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
            <?php endforeach; ?>
        </div>
    </div>
</div>