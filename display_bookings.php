<html>
    <h3 class="text-center py-4">Manage Existing Bookings</h3>
    <div class="col-md-10 offset-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location</th>
                    <th scope="col">Manage</th>
                </tr>
                <tbody>
                    <?php if(isset($bookings) && $hasbookings)
                    
                    foreach($bookings as $row){
                        $url = base_url("book/remove_booking/?canceldate=$row->date&canceltime=$row->time&cancellocation=$row->location");
                        echo "
                            <tr>
                                <td>$row->date</td>
                                <td>$row->time</td>
                                <td>$row->location</td>
                                <td><a href='$url'>Cancel Booking</a></td>
                            </tr>
                        "; 
                        }?>
                </tbody>
            </thead>
        </table>
        <?php echo $cancelmessage?>
    </div>
    
</html>