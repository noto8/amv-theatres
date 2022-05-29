<?php
    require 'assets/db_connect.php';
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM cinema WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $film = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

    $seats = implode('_', array_keys($_POST));
    if(strlen($seats) > 0){
        session_start();
        $_SESSION['seats'] = $seats;
    }
?>



<!-- Head -->
<?php $title = $film['title']." Summary at AMV Theatres"; require 'templates/head.php'; ?>

<body style="overflow: hidden;">

<!-- Header -->
<?php $header = "Summary"; ?>
<?php require 'templates/header_seats.php'; ?>

<div class="wrapper summary">
    <form action=<?php echo "payment.php?id=".$_GET['id']."&date=".$_GET['date']."&theatre=".$_GET['theatre']."&time=".$_GET['time']; ?> method="post">
        <div class="checkout">
            <h2>Order Details</h2>
            <?php
                echo "
                    <div class='hl'>Film</div>
                    <div>".$film['title']."</div>
                ";
                foreach($_GET as $index => $item){
                    if($index != 'id'){
                        if($index == 'theatre') $item = implode(" ", explode("_", $_GET['theatre']));
                        echo "
                            <div class='hl'>".$index."</div>
                            <div>".$item."</div>
                        ";
                    }
                }
                $cost = $film['price'] * sizeof($_POST);
                echo "
                    <div><div class='hl'>Seat"; if(sizeof($_POST) > 1) echo "s"; echo "</div>"; foreach($_POST as $seat => $a) echo "<div class='seat'><span>".$seat."</span><span>$".$film['price']."</span></div>"; echo "</div>
                    <div class='divider'></div>
                    <div class='total'><span class='hl' style='text-transform: capitalize;'>Order Total:</span> <span class='cost'>$".$cost."</span></div>
                    <input type='number' value='".$cost."' name='cost'>
                ";
            ?>
        </div>

        <div class="continue-cont">
            <div class="wrapper">
                <button type="submit">Purchase</button>
            </div>
        </div>
    </form>
</div>



<script src="script/seats.js"></script>
</body>
</html>