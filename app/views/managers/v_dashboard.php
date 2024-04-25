<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="home">
    <div class="manager-page">
        <h1 style="text-align: left; color: #003366;">Dashboard</h1>

        <div class="overview-section">
            <h2 class="overview-heading">Occupancy Overview</h2>
            <div class="overview-row">
                <div class="overview-item">
                    <div class="overview-col">
                        <div class="overview-col-image-1"><i class="fa-solid fa-hotel"></i></div>
                        <div class="overview-col-details">
                            <span class="overview-col-value">
                                <?php echo $data['totalrooms']; ?>
                            </span>
                            <span class="overview-col-text-1">Total Rooms</span>
                        </div>
                    </div>

                </div>
                <div class="overview-item">
                    <div class="overview-col">
                        <div class="overview-col-image-2"><i class="fa-solid fa-door-closed"></i></div>
                        <div class="overview-col-details">
                            <span class="overview-col-value">
                                <?php echo $data['occupiedrooms']; ?>
                            </span>
                            <span class="overview-col-text-2">Occupied Rooms</span>
                        </div>
                    </div>
                </div>
                <div class="overview-item">
                    <div class="overview-col">
                        <div class="overview-col-image-3"><i class="fa-solid fa-door-open"></i></div>
                        <div class="overview-col-details">
                            <span class="overview-col-value">
                                <?php echo $data['availablerooms']; ?>
                            </span>
                            <span class="overview-col-text-3">Available Rooms</span>
                        </div>
                    </div>
                </div>
                <div class="overview-item">
                    <div class="overview-col">
                        <div class="overview-col-image-4"><i class="fa-solid fa-building-lock"></i></div>
                        <div class="overview-col-details">
                            <span class="overview-col-value">
                                <?php echo $data['occupancyrate']; ?>%
                            </span>
                            <span class="overview-col-text-4">Occupancy Rate</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="overview-box">
            <div class="overview-section-2">
                <h2 class="overview-heading">Guests Overview</h2>
                <!-- <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-4"><i class="fa-solid fa-bed"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">100</span>
                                <span class="overview-col-text-4">Inhouse Guests</span>
                            </div>
                        </div>

                    </div>
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-5"><i class="fa-solid fa-person-walking-luggage"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">100</span>
                                <span class="overview-col-text-5">Expected Guests</span>
                            </div>
                        </div>

                    </div>
                </div> -->
                <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-6"><i class="fa-solid fa-right-from-bracket"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['checkinCount']; ?>
                                </span>
                                <span class="overview-col-text-6">Check-ins</span>
                            </div>
                        </div>

                    </div>
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-1"><i
                                    class="fa-solid fa-right-from-bracket fa-rotate-180"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['checkoutCount']; ?>
                                </span>
                                <span class="overview-col-text-1">Check-outs</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="overview-section-2">
                <h2 class="overview-heading">Housekeeping Overview</h2>
                <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-7"><i class="fa-solid fa-person-circle-question"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['serviceRequestsCount']; ?>
                                </span>
                                <span class="overview-col-text-7">Requests</span>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-6"><i class="fa-solid fa-hand-sparkles"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['ongoingRequestsCount']; ?>
                                </span>
                                <span class="overview-col-text-6">Ongoing</span>
                            </div>
                        </div>

                    </div> -->
                </div>
                <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-4"><i class="fa-solid fa-clock"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['pendingRequestsCount']; ?>
                                </span>
                                <span class="overview-col-text-4">Pending </span>
                            </div>
                        </div>

                    </div>
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-5"><i class="fa-solid fa-circle-check"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['completedRequestsCount']; ?>
                                </span>
                                <span class="overview-col-text-5">Completed</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <div class="overview-box">
            <div class="overview-section-2">
                <h2 class="overview-heading">Kitchen Overview</h2>
                <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-2"><i class="fa-solid fa-burger"></i></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['foodOrderCount']; ?>
                                </span>
                                <span class="overview-col-text-2">Total Food Orders</span>
                            </div>
                        </div>

                    </div>
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-6"><i class="fa-solid fa-square-check"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['placedOrderCount']; ?>
                                </span>
                                <span class="overview-col-text-6">Placed</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-3"><i class="fa-solid fa-fire-burner"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['preparingOrderCount']; ?>
                                </span>
                                <span class="overview-col-text-3">Preparing</span>
                            </div>
                        </div>

                    </div>
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-7"><i class="fa-solid fa-bowl-food"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['dispatchOrderCount']; ?>
                                </span>
                                <span class="overview-col-text-7">Dispatch</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="overview-row">
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-5"><i class="fa-solid fa-book-open"></i></div>
                            <div class="overview-col-details">
                                <span class="overview-col-value">
                                    <?php echo $data['foodMenuCount']; ?>
                                </span>
                                <span class="overview-col-text-5">Food Items <br>for today</span>
                            </div>
                        </div>

                    </div>
                    <div class="overview-item">
                        <div class="overview-col">
                            <div class="overview-col-image-1"><i class="fa-solid fa-book-open"></i></div>
                            <div class="overview-col-details">

                                <span class="overview-col-text-1" id="viewMenuBtn">View <br>Today's<br>Menu</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="overview-piechart">
                <h2>Monthly Income</h2>
                <canvas id="pieChart" width="420" height="200"></canvas>
            </div>
            <?php $reservationIncome = $data['reservationIncome'];

            ?>
            <?php
            $foodOrderIncome = $data['foodOrderIncome']; ?>
        </div>

        <!-- Modal -->



        <div id="menuModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Today's Menu</h2>
                <!-- Table to display food items -->
                <table>

                    <tr>

                        <th>Food Item</th>

                        <th>Price (LKR)</th>

                    </tr>

                    <?php
                    foreach ($data['foodMenu'] as $foodMenu): ?>
                        <tr>
                            <td>
                                <?php echo $foodMenu->name; ?>
                            </td>

                            <td>
                                <?php echo $foodMenu->price; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>


    </div>

</div>
</div>

<script>

    // Sample data (replace with actual data fetched from backend)
    const data = {
        labels: ['Reservations Income (LKR)', 'Food Orders Income (LKR)'],
        datasets: [{
            data: [<?= $reservationIncome ?>, <?= $foodOrderIncome ?>],
            backgroundColor: ['#36A2EB', '#FFCE56']
        }]
    };

    // Create the pie chart
    const ctx = document.getElementById('pieChart').getContext('2d');
    const myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false // Set to false to prevent resizing
        }
    });


    // Get the modal element
    var modal = document.getElementById("menuModal");

    // Get the button that opens the modal
    var btn = document.getElementById("viewMenuBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>