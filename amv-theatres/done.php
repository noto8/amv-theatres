<?php
    require 'assets/db_connect.php';
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM cinema WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $film = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }

    session_start();
    $seats = explode("_", $_SESSION['seats']);
    $occupied = explode("\r\n", $film['occupied_seats']);
    foreach($seats as $seat) array_push($occupied, $_GET['date']." ".$_GET['theatre']." ".$_GET['time']." ".$seat);
    $occupied = array_unique($occupied);
    $occupied = implode("\r\n", $occupied);
    $sql = "UPDATE cinema SET occupied_seats='$occupied' WHERE id='$id'";
    $conn->query($sql);
    mysqli_close($conn);
?>



<!-- Head -->
<?php $title = $film['title']." at AMV Theatres"; require 'templates/head.php'; ?>

<body style="overflow: hidden;">

<!-- Header -->
<?php $header = "Payment"; ?>
<?php require 'templates/header_alt.php'; ?>



<div class="done">
    <h1>Done! Check your E-Mail.</h1>
    <h3>Thank you for enjoying moviewatching with us! See you in the theatre!</h3>
    <a href="index.php" class="button primary">Main Page</a>
    <?php
        $subject = "Your tickets";

        $message = "
            <span>Scan the barcode before the theatre room enterance to enjoy the film!</span>
            <h3>".$film['title']."</h3>
            <b>".implode(" ", explode("_", $_GET['theatre']))."</b><br>
            <b>".$_GET['time']." ".date("D", strtotime($_GET['date']))." ".date("Y/m/d", strtotime($_GET['date']))."</b>
            <div>Total: $".$film['price'] * sizeof($seats)."</div>
            <div>Seat"; if(sizeof($seats) > 1) $message .= "s"; $message .= " <h1>".implode(', ', $seats)."</h1></div>
            <h5>".strtoupper($film['rating'])."</h5>
            <img src='https://www.free-barcode-generator.net/images/amp/codabar-rationalized.png'>";

        $headers = "From: AMV Theatres <ghbdtnghbdtn8@gmail.com>\r\n";
        $headers .= "Content-type: text/html\r\n";
        mail($_POST['email'], $subject, $message, $headers);
    ?>
</div>



<script src=""></script>
</body>
</html>