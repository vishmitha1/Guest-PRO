<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">

    <h1>Room Management</h1>

    <!-- Add Room button -->
    <div class="addnewbutton">
        <a href=" <?php echo URLROOT; ?>/Managers/addroom">Add Room</a>
    </div>

    <!-- Add Room Type button -->
    <div class="addnewbutton">
        <a href=" <?php echo URLROOT; ?>/Managers/viewroomtype ">Add Room Type</a>
    </div>

    <!-- Search bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="searchRooms()">Search</button>
    </div>

    <!-- Display Rooms -->
    <table class="table" id="managerRoomDetailsTable">
        <!-- Table headers -->
        <tr>
            <th>Room NO</th>
            <!-- <th>Floor NO</th> -->
            <th>Category</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
        <!-- PHP loop to display room details -->

        <?php
        foreach ($data['rooms'] as $room): ?>
            <tr>
                <td>
                    <?php echo $room->roomNo; ?>
                </td>
                <!-- <td>
                        <?php echo $room->floor; ?>
                    </td> -->
                <td>
                    <?php echo $room->category; ?>
                </td>
                <td>
                    <?php echo $room->price; ?>
                </td>
                <td>
                    <?php echo $room->availability; ?>
                </td>
                <td>

                    <a href="<?php echo URLROOT; ?>/Managers/editRoom/<?php echo $room->roomNo; ?>"><i
                            class="far fa-edit"></i></a>


                    <a href="<?php echo URLROOT; ?>/Managers/deleteRoom/<?php echo $room->roomNo; ?>"
                        onclick="return confirm('Are you sure you want to delete this room?')"><i
                            class='fa-solid fa-trash fa-lg'></i></a>


                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function searchRooms() {

        }

    </script>

</div>