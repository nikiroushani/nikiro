<html>
    
    <?php echo form_open(base_url().'book/make_booking'); ?>
        <div class="container">
            <h2 class="text-center py-4">Book New Appointment</h2>
            <hr>
            <h5 class="text-center py-1">Choose a Date</h5>
            <div class="col-md-4 offset-4">
                <input type="date" class="form-control" name="bookingdate" required>
            </div>
            <hr>
            <h5 class="text-center py-1">Choose a Time</h5>
            <div class="col-md-4 offset-4">
                <input type="time" class="form-control" name="bookingtime" required>
            </div>
            <hr>
            <h5 class="text-center py-1">Choose a Location</h5>
            <div class="col-md-6 offset-3">
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                        <?php echo form_open('ajax'); ?>
                            <input class="form-control mr-sm-2 col-lg-10" type="search" placeholder="Enter a Postcode" aria-label="Search" name="search" id="search_text">

                            <button class="search-btn btn btn-outline-dark my-2 my-sm-0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Search</button>
                        <?php echo form_close(); ?>
                    </form>
                </nav>
            </div>
            <div class="container h-100">
                <div class="collapse col-10 offset-1" id="collapseExample">
                <div class="card card-body col-10 offset-1" id="result"></div>
            </div>
            <hr>
            <h5 class="text-center py-2">Dose Number</h5>
            <div class="col-md-3 offset-5">
                <select name="dose" class="form-control" required>
                    <option>Dose 1</option>
                    <option>Dose 2</option>
                </select>
            </div>
            <hr>
            <h5 class="text-center py-2">Enter Contact Details</h5>
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
                        <option>Male</option>
                        <option>Female</option>
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
                    <select name="origin" class="form-control" required>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">Mobile Number</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="cohort">Cohort</label>
                    <select name="cohort" class="form-control" required>
                        <option>Under 60</option>
                        <option>Over 60</option>
                        <option>Pregnant</option>
                    </select>
                </div>
            </div>
            <?php echo $error?>
            <div class="form-group pt-2 offset-6">
                <button type="submit" class="btn btn-dark">Book</button>
            </div>
        
        </div>
    <?php echo form_close(); ?>
</html>

<script>
    $(document).ready(function(){
    load_data();
        function load_data(query){
            $.ajax({
            url:"<?php echo base_url(); ?>ajax/fatch",
            method:"GET",
            data:{query:query},
            success:function(response){
                $('#result').html("");
                if (response == "" ) {
                    $('#result').html(response);
                    
                }else{
                    var obj = JSON.parse(response);
                    if(obj.length>0){
                        var items=[];
                        $.each(obj, function(i,val){
                            
                            items.push($('<div style="white-space:nowrap"><input type="checkbox" name="location" class="px-2" value="' + val.name +'"><label for="location" class="px-2">'+ val.name + " " + val.suburb + " " + val.postcode +'</label></div>'));
                            
                    });
                    $('#result').append.apply($('#result'), items);         
                    }else{
                    $('#result').html("Not Found!");
                    }; 
                };
            }
        });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }else{
                load_data();
            }
        });
    });
</script>



