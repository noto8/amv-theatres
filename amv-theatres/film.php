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
<?php $title = $film['title'] . " at an AMV Theatre near you."; require 'templates/head.php'; ?>

<body>
    
<!-- Header -->
<?php require 'templates/header.php'; ?>



<!-- Hero -->
<div class="hero" style="background-image: url('<?php echo "./style/images/hero/".$film['id'].".jpg?t=".time(); ?>');">
    <div class="wrapper">
        <div class="content">
            <h1><?php echo $film['title']; ?></h1>
            <?php
                foreach(explode("\n", $film['show_schedule']) as $date)
                    if(strtotime($date) >= strtotime(date("Y-m-d"))){
                        echo "<a href='session.php?id=".$film['id']."&date=".explode(" ", $date)[0]."' class='button primary'>Get Tickets</a>";
                        break;
                    }
            ?>
        </div>
    </div>
</div>

<!-- Description -->
<div class="wrapper">
    <div class="film-content">
        <h2 class="headline"><?php if($film['headline']) echo $film['headline']; ?></h2>
        <div class="about">
            <ul>
                <li><?php echo date('g', strtotime($film['duration']))." H ".date('i', strtotime($film['duration']))." MIN<span>|</span>".$film['rating']; ?></li>
                <li><?php echo date('M', strtotime($film['release_date']))." ".date('d', strtotime($film['release_date'])).", ".date('Y', strtotime($film['release_date'])); ?></li>
                <li><?php echo $film['genre']; ?></li>
            </ul>
            <div class="description"><?php echo $film['description']; ?></div>
        </div>
    </div>
</div>

<!-- Carousel -->
<div class="carousel">
    <div class="carousel-viewport">
        <ul class="carousel-slides" id="carouselSlides">
            <?php
                $images = glob("./style/images/screenshots/".$film['id']."/*.jpg");
                $imgs_num = sizeof($images);
                for($i=0; $i < $imgs_num; $i++) echo "<li class='carousel-slide'><img src='".$images[$i]."?t=".time()."' alt='' data-pos='".($i*-100)."'></li>";
            ?>
        </ul>
    </div>
    <ul class="navigation">
        <?php for($i=0; $i < $imgs_num; $i++) echo "<li class='dot' data-pos='".($i*-100)."'></li>"; ?>
    </ul>
</div>

<!-- Cast & Crew -->
<div class="wrapper">
    <div class="CastCrew">
        <h2>Cast & Crew</h2>
        <ul>
            <?php
                $rows = explode("\n", $film['cast_crew']);
                foreach($rows as $row){
                    $pair = explode(',', $row);
                    echo "<li><h3>".$pair[0]."<span>".$pair[1]."</span></h3></li>";
                }
            ?>
        </ul>
    </div>
</div>



<!-- Footer -->
<?php $script = "script/film.js"; require 'templates/footer.php'; ?>