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
<?php $title = "Ticket Purchasement at AMV Theatres"; require 'templates/head.php'; ?>

<body style="overflow: hidden;">

<!-- Header -->
<?php $header = "Payment Details"; ?>
<?php require 'templates/header_alt.php'; ?>



<div class="wrapper">
    <form action=<?php echo "done.php?id=".$_GET['id']."&date=".$_GET['date']."&theatre=".$_GET['theatre']."&time=".$_GET['time']; ?> class="payment" method="post">
        <span>Email</span>
        <input type="email" name="email" required>
        <span>Card Number</span>
        <input type="text" disabled>
        <span>Name</span>
        <input type="text" disabled>
        <div style="display: flex;">
            <div style="margin: 0 12px 0 0">
                <span>Valid Thru</span>
                <input type="text" disabled>
            </div>
            <div>
                <span>CVV</span>
                <input type="text" disabled>
            </div>
        </div>

        <button type="submit" class="button primary">Continue</button>
    </form>
</div>



<script src=""></script>
</body>
</html>