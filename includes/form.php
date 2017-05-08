<?php
    include('airports.php')
?>

<form action="pdf.php" method="POST">
    <label for="">Choose your departure airport:</label>
        <select class="form-control " name="departureAirport">
            <?php foreach ($airports as $key => $value) {
                echo "<option value='". $airports[$key]['code'] . "'>" . $value['name'] . "</option>";
                }
            ?>
        </select><br><br>
    <label for=""> Choose your destination airport:</label>
        <select class="form-control " name="destinationAirport">
            <?php foreach ($airports as $key => $value) {
                echo "<option value='". $airports[$key]['code'] . "'>" . $value['name'] . "</option>";
                }
        ?>
        </select><br><br>
    <label for="">Start date:</label>
        <input type="datetime-local" name="startDate" placeholder="Date"><br>
    <label for="">Flight length: </label>
        <input type="number" class="form-control" min="0" step="1" name="flightLength" placeholder="Hours..."><br>
    <label for="">Flight price: </label>
        <input type="number" class="form-control" min="0.00" step="0.01" name="price" placeholder="Price..."><br><br>
    <button type="submit" name="send"> Send </button>

</form>