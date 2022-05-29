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
?>



<!-- Head -->
<?php $title = $film['title']." Seats at AMV Theatres"; require 'templates/head.php'; ?>

<body>

<!-- Header -->
<?php $header = "Select Seats"; require 'templates/header_seats.php'; ?>



<div class="seats-cont">
    <div class="wrapper">
        <div class="screen">SCREEN</div>
        <div class="seats">
            <?php echo "<form action='summary.php?id=".$_GET['id']."&date=".$_GET['date']."&theatre=".$_GET['theatre']."&time=".$_GET['time']."' method='post'>"; ?>
                <?php
                    $sr = 16; //seats in a row
                    $alph = range( 'A', 'Z' );
                    for($row=0; $row < 6; $row++){
                        echo "<div class='row'>";
                        $occupied = explode("\r\n", $film['occupied_seats']);
                        for($num=0; $num<$sr; $num++){
                            echo "
                                <input id='seat_".$row.$num."' type='checkbox' name='".$alph[$row].$sr-$num."' onchange='seatsCounter(this)' autocomplete='off' class='"; if(in_array($_GET['date']." ".$_GET['theatre']." ".$_GET['time']." ".$alph[$row].$sr-$num, $occupied)) echo "occupied"; echo"'>
                                <label for='seat_".$row.$num."' class='seat"; if($num == 11) echo " mr"; else if($num == 4) echo " ml";  echo "'>
                                    <div><span>".$alph[$row].$sr-$num."</span></div>
                                </label>";
                        }
                        echo "</div>";
                    }
                ?>
                <div class="continue-cont">
                    <div class="wrapper">
                        <div id="seatsQ"></div>
                        <button type="submit" disabled id="continueBtn">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="script/seats.js"></script>
</body>
</html>