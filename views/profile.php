<div class="container">
    <h2 class="text-center py-2">Profile Details</h2>
    <hr>
    <?php echo form_open(base_url().'profile/update'); ?>
        <div class="form-row pt-2">
            <div class="form-group col-md-4">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" value="<?php echo $firstname?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="middlename">Middle Name</label>
                <input type="text" class="form-control" name="middlename" value="<?php echo $middlename?>">
            </div>
            <div class="form-group col-md-4">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" value="<?php echo $lastname?>" required>
            </div>
        </div>
        <div class="form-row pt-2">
            <div class="form-group col-md-4">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="suburb">Suburb</label>
                <input type="text" class="form-control" name="suburb" value="<?php echo $suburb?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="postcode">Postcode</label>
                <input type="text" class="form-control" name="postcode" value="<?php echo $postcode?>" required>
            </div>
        </div>
        <div class="form-row pt-2">
            <div class="form-group col-md-4">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control" required>
                    <option <?php if ($gender == 'Male') echo 'selected = "selected"'?>>Male</option>
                    <option <?php if ($gender == 'Female') echo 'selected = "selected"'?>>Female</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" name="dob" value="<?php echo $dob?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="medicare">Medicare Number</label>
                <input type="text" class="form-control" name="medicare" value="<?php echo $medicare?>" required>
            </div>
        </div>
        <div class="form-row pt-2">
            <div class="form-group col-md-4">
                <label for="origin">Aboriginal or Torres Strait Islander Origin</label>
                <select name="origin" class="form-control" value="<?php echo $origin?>" required>
                    <option <?php if ($origin == 'Yes') echo 'selected = "selected"'?>>Yes</option>
                    <option <?php if ($origin == 'No') echo 'selected = "selected"'?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Mobile Number</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $phone?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="cohort">Cohort</label>
                <select name="cohort" class="form-control" value="<?php echo $cohort?>" required>
                    <option>Under 60</option>
                    <option>Over 60</option>
                    <option>Pregnant</option>
                </select>
            </div>
        </div>
        <?php echo $error?>
        <div class="form-group pt-2">
            <button type="submit" class="btn btn-dark">Update</button>
        </div>
    <?php echo form_close(); ?>
</div>

