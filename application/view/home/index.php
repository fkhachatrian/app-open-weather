<div class="container">
    <h1>Set your location</h1>
    <h2>Current Location: <?php echo $currentLocation ? $currentLocation : "Not set, will use your current location..."; ?></h2>
    <?php if ( $currentLocation ) { ?>
    <form action="<?php echo URL; ?>home/clearlocation" method="POST">
        <input id="location-submit" type="submit" name="clear_location" value="Clear Location" />
    </form>
    <?php } ?>
    <!-- add song form -->
    <div class="box">
        <form action="<?php echo URL; ?>home/setlocation" method="POST">
            <label>Location</label>
            <input id="location-input" type="text" name="location" value="" required />
            <input id="location-submit" type="submit" name="set_location" value="Submit" />
        </form>
    </div>
</div>
