<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <h1>Service Requests</h1>

    <!-- Display service requests -->
    <div class="view-container">
        <?php foreach ($data['requests'] as $request): ?>
            <div class="request-item">
                <div class="request-details">
                    <h2>Room Number:
                        <?php echo $request->roomNo; ?>
                    </h2>
                    <p>User Id:
                        <?php echo $request->user_id; ?>
                    </p>
                    <p>Category:
                        <?php echo $request->category; ?>
                    </p>
                    <p>Date:
                        <?php echo $request->date; ?>
                    </p>
                    <p>Status:
                        <?php echo $request->status; ?>
                    </p>
                    <p>Additional Details:
                        <?php echo $request->AddDetails; ?>
                    </p>
                    <p>Special Instructions:
                        <?php echo $request->SpecDetails; ?>
                    </p>
                </div>

                <!-- Request details -->
                <div class="request-actions">
                    <!-- Form for marking as complete -->
                    <form action="<?php echo URLROOT; ?>/Managers/markAsComplete" method="POST">
                        <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                        <button type="submit" class="complete-button">Mark as Complete</button>
                    </form>
                </div>


            </div>
        <?php endforeach; ?>
    </div>
</div>