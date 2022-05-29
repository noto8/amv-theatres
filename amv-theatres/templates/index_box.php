<div class="box">
    <a href="<?php echo "film.php?id=".$film['id']; ?>" class="cover"><img src="url('<?php echo "/../style/images/Posters/".$film['id'].".jpg?t=".time();?>')" alt="" height="500px" width="auto"></a>
    <div class="about">
        <div class="title"><a href="<?php echo "film.php?id=".$film['id']; ?>"><?php echo $film['title']; ?></a></div>
        <div class="description"><?php echo $film['description']; ?></div>
        <div class="info"><?php echo date('g', strtotime($film['duration']))." H ".date('i', strtotime($film['duration']))." MIN<span>|</span>".$film['rating']; ?></div>
        <div class="date"><?php echo "Released ".date('M', strtotime($film['release_date']))." ".date('d', strtotime($film['release_date'])).", ".date('Y', strtotime($film['release_date'])); ?></div>
        <?php
            foreach(explode("\n", $film['show_schedule']) as $date)
                if(strtotime($date) >= strtotime(date("Y-m-d"))){
                    echo "<a href='session.php?id=".$film['id']."&date=".explode(" ", $date)[0]."' class='button primary'>Get Tickets</a>";
                    break;
                }
        ?>
    </div>
</div>