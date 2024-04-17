<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <div class="title-generate_reports">
        <h1>Generate Reservation Report</h1>
    </div>

    <div class="report-form">
        <form action="<?php echo URLROOT; ?>/Reports/reservation_report" method="POST">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>

    <?php if (!empty($data['reservations'])) : ?>
        <div class="reservation-table">
            <h2>Reservation Report</h2>
            <table>
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>User ID</th>
                        <th>Guest Name</th>
                        <th>Room No</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                       
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['reservations'] as $reservation) : ?>
                        <tr>
                            <td><?php echo $reservation->reservation_id; ?></td>
                            <td><?php echo $reservation->user_id; ?></td>
                            <td><?php echo $reservation->customer_name; ?></td>
                            <td><?php echo $reservation->roomNo; ?></td>
                            <td><?php echo $reservation->checkIn; ?></td>
                            <td><?php echo $reservation->checkOut; ?></td>
                            
                            <!-- Add more columns as needed -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php else : ?>
        <p>NO reservations during this time</p>
        
    <?php endif; ?>

</div>
