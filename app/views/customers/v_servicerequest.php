<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="home">
    <div class="serviceReq-container">
        <div class="serviceReq-container-wrapper">
            <div class="title">
                <span>Service Request</span>
            </div>
            <form action="<?php echo URLROOT;?>/Customers/serviceRequest" method='POST' >
                <div class="input-box">
                <lable class="material-symbols-outlined">Format_List_Bulleted</lable><span>Service Type</span> <br>
                    <select name="category" id="category">
                        <option hidden value=''>Select One</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Snack Refill">Snack Refill</option>
                        <option value="Health and Wellness">Health and Wellness</option>
                        <option value="Cleaning">Cleaning</option>
                        <option value="Accessibility">Accessibility</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="input-box">
                <lable class="material-symbols-outlined">Text_Snippet</lable><span>Additional Details</span> <br>
                    <textarea name="AddDetails" id="details" style='width:60%;height:20%' ></textarea>
                </div>
                <div class="input-box">
                <lable class="material-symbols-outlined">more</lable><span>Special Instructions</span> <br>
                    <textarea  name="SpecDetails"  ></textarea>
                </div>

                <div class="send-req">
                    <button type="submit" class="btn">Send Request</button>
                </div>

            </form>
        </div>
    </div>

</div>


