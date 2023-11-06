

<?php
$host = "webdev.iyaserver.com";
$userid = "sandmanl";
$userpw = "Ace-sweden-sonority89!";
$db = "sandmanl_la_spots";


$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}
?>
<link rel="stylesheet" href="stylesheet.css">
<html>
<header>
    <title>Find Your Spot!</title>
</header>
<body>


<div>
    <h1>SEARCH</h1>
    <form class = "formcontainer" align="center" action="results-spots.php">
        <div class="formtitles">Name of spot</div><input type="text" name="name" placeholder="name of spot">
        <br><br>
        <div class="formtitles">Address</div><input type="text" name="address" placeholder="address">
        <br><br>
        <div class="formtitles">Type of Spot</div>
        <br>
        <select name="type">
            <option value="ALL">All</option>
            <?php

            $sql = "SELECT * FROM types";

            $results = $mysql->query($sql);

            if(!$results) {
                echo "SQL error: ". $mysql->error;
                exit();
            }

            while($currentrow = $results->fetch_assoc()) {
                echo "<option>" . $currentrow['type'] . "</option>";
            }
            ?>
        </select>
        <br>
        <div class="formtitles">Interest</div>
        <br>
        <select name="interest">
            <option value="ALL">All</option>
            <?php

            $sql = "SELECT * FROM interests";

            $results = $mysql->query($sql);

            if(!$results) {
                echo "SQL error: ". $mysql->error;
                exit();
            }

            while($currentrow = $results->fetch_assoc()) {
                echo "<option>" . $currentrow['interest'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <div class="formtitles">Price level</div>
        <br>
        <select name="price">
            <option value="ALL">All</option>
            <?php

            $sql = "SELECT * FROM prices";

            $results = $mysql->query($sql);

            if(!$results) {
                echo "SQL error: ". $mysql->error;
                exit();
            }

            while($currentrow = $results->fetch_assoc()) {
                echo "<option>" . $currentrow['price'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <button type="submit" class="round-button green">Submit Search</button>
    </form>
</div>



</body>
</html>
