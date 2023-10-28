<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/mainstyle.css' >
</head>
<body>
    <div class="foodorder-form">
        <div class="main-title">Update Food Order</div>
        <div class="foodorder-form-wrapper">
            <form action="<?php echo URLROOT;?>/Customers/updateorderdetails/<?php echo $data[2];?>" method="POST" >
                
                <span class="form-title">Select Item:</span>
                <div class="foodorder-field">
                    <select name="food" id="food" >
                        <option value="sandwitch" <?php if($data[0]=="sandwitch") echo"selected";?> >Sandwitch</option>
                        <option value="friderice" <?php if($data[0]=="friderice") echo"selected";?>>FriedRice</option>
                        <option value="kottu" <?php if($data[0]=="kottu") echo"selected";?>>Kottu</option>
                    </select>
                </div>
                <span class="form-title">Quantity:</span>
                <div class="foodorder-field">
                    <input type="text" name="quantity" value="<?php echo $data[1];?>" >
                </div>
                <span class="form-title">Add note:</span>
                <div class="foodorder-field">
                    
                    <textarea id="note" name="note" rows="4" cols="50"></textarea>
                </div>
                
                

                <div class="foodorder-button">
                    <input type="submit" name="submit" value="Update">
                </div>
    
            </form>

        </div>
    </div>
</body>
</html>
