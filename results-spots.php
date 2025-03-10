<html>
<head>
    <title>LA Spots!</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QL7D4BF2WZ');
</script>
<body>
<?php
    include './navbar.php';
    echo $navbar;
?>
<div class="margins">
<?php

if(empty($_REQUEST['type'])) {
    header("Location: search-spots.php");
}

$host = "webdev.iyaserver.com";
$userid = "sandmanl";
$userpw = "Ace-sweden-sonority89!";
$db = "sandmanl_la_spots";

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
); //

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql = 	"SELECT * FROM spot_view2 WHERE 1=1";
if(!empty($_REQUEST['name'])) {
    $sql .= " AND name LIKE '%" . $_REQUEST["name"] . "%'";
}
if(!empty($_REQUEST['address'])) {
    $sql .= " AND address LIKE '%" . $_REQUEST["address"] . "%'";
}
if($_REQUEST['type'] != "ALL") {
    $sql .=		" AND type = '" . $_REQUEST["type"] . "'";
}

if($_REQUEST['interest'] != "ALL") {
    $sql .=		" AND interest = '" . $_REQUEST["interest"] . "'";
}
if($_REQUEST['price'] != "ALL") {
    $sql .=		" AND price = '" . $_REQUEST["price"] . "'";
}
//$sql .= " AND price < '" . $_REQUEST["max_price"] . "'";
//$sql .= " AND price > '" . $_REQUEST["min_price"] . "'\n";


$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

echo "<em>Found <strong>" .
    $results->num_rows .
    "</strong> results.</em>";
echo "<br><br>";

//while($currentrow = $results->fetch_assoc()) {
//    echo "<img alt='" . $currentrow['name'] . "' src='" . $currentrow['photo'] . "' width=100px> " .
//        "<strong><a href='details-spots.php?id=" . $currentrow['spot_id'] . "'" .
//        $currentrow['name'] . "</strong></a>" .
//        $currentrow['address'] . "<em>" .
//        $currentrow['type'] . "</em>" .
//        $currentrow['interest'] .
//        $currentrow['price'];
//}

?>

<div class="gallery">

    <?php

    $start = 1;
    $end = 10;
    $counter = $start;
    $results->data_seek($start-1); // this is for the paginated shit lol

    while($currentrow = $results->fetch_assoc()): ?>

        <div class="gallery-item">

            <div class="image" style="background-image: url('<?php echo $currentrow['photo_url']; ?>')"></div>

            <a class="details" href="details-spots.php?id=<?php echo $currentrow['spot_id']?>">
                <div class="overlay">
                <h3 class="location-tag">&#128205;<?php echo utf8_decode($currentrow['name']); ?></h3>
                <p class="address"><?php echo $currentrow['address']; ?></p>
                <p><em><?php echo $currentrow['type']; ?></em></p>
                <p><?php echo $currentrow['interest']; ?></p>
                <p><?php echo $currentrow['price']; ?></p>
                </div>
            </a>

        </div>

    <?php endwhile; ?>

</div>
</div>


</body>
</html>

