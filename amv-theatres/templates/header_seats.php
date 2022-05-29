<header class="alt">
    <?php require "templates/header_alt_topCont.php"; ?>
    <ul class="sh">
        <div class="wrapper" style="justify-content: start;">
            <div style="display: flex;">
                <img src="<?php echo "./style/images/Posters/".$film['id'].".jpg?t=".time();?>" alt="" height="67.8px">
                <div>
                    <h1><a href="<?php echo "film.php?id=".$film['id']; ?>"><?php echo $film['title']; ?></a></h1>
                    <div class="info"><?php echo implode(" ", explode("_", $_GET['theatre']))."<span>|</span>".date("M d, Y", strtotime($_GET['date']))."<span>|</span>".$_GET['time']; ?></div>
                </div>
            </div>
        </div>
    </ul>
</header>