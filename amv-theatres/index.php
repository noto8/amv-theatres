<?php
    require 'assets/db_connect.php';
    $sql = 'SELECT * FROM `cinema` ORDER BY `cinema`.`id` DESC';
    $result = mysqli_query($conn, $sql);
    $films = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>



<!-- Head -->
<?php $title = "AMV Theatres - movie times, buy tickets and gift cards."; require 'templates/head.php'; ?>

<!-- Header -->
<?php require 'templates/header.php'; ?>



<!-- Box -->
<div class="wrapper">
<?php foreach($films as $film) {
    $shown = false;
    require 'assets/get_schedule.php';
    foreach($show as $date => $time){
        if($date > date("Y-m-d")){ 
            require 'templates/index_box.php';
            $shown = true;
            break;
        }
    }
    if(!$shown && array_key_exists(date("Y-m-d"), $show)){
        foreach($show[date("Y-m-d")] as $time){
            if(strtotime($time) > strtotime(date("H:i"))){
                require 'templates/index_box.php';
                break;
            }
        }
    }
}
?>
</div>



<!-- Footer -->
<?php $script = ""; require 'templates/footer.php'; ?>