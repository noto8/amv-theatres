<?php
    require 'assets/db_connect.php';
    $sql = 'SELECT * FROM cinema';
    $result = mysqli_query($conn, $sql);
    $films = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>



<!-- Head -->
<?php $title = ""; require 'templates/head.php'; ?>

<!-- Header -->
<?php require 'templates/header.php'; ?>







<!-- Footer -->
<?php $script = ""; require 'templates/footer.php'; ?>