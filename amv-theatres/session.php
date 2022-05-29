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

    //schedule
    require 'assets/get_schedule.php';
?>



<!-- Head -->
<?php $title = $film['title']." Times at AMV Theatres"; require 'templates/head.php'; ?>

<body style="overflow: hidden;">

<!-- Header -->
<?php $header = "Select Session"; require 'templates/header_session.php'; ?>



<div class="wrapper flex">
    <div class="session_cont">
        <?php
            $thetres = explode("\r\n", $film['theatres']);
            if($_GET['date'] == date("Y-m-d") && array_key_exists(date("Y-m-d"), $show)){
                foreach($thetres as $theatre)
                    foreach($show[date("Y-m-d")] as $time)
                        if(strtotime($time) > strtotime(date("H:i"))){
                            echo "<h4 class='theatre'>".$theatre."</h4><ul class='timetable'>";
                            foreach($show[date("Y-m-d")] as $aaa => $time1)
                                if(strtotime($time1) > strtotime(date("H:i"))){
                                    $res = substr_count($film['occupied_seats'], $_GET['date']." ".implode("_", explode(" ", $theatre))." ".date("H:i", strtotime($time1)));
                                    if($res > 95){ echo
                                        //disabled
                                        "<li class='time-cell disabled'>
                                            <a>".$time1."</a>
                                            <div class='info'>SOLD OUT</div>
                                        </li>
                                    "; continue;}
                                    else if($res > 86) $res = "ALMOST FULL";
                                    else $res = "";
                                    echo
                                        //enabled
                                        "<li class='time-cell'>
                                            <a href='seats.php?id=".$film['id']."&date=".date("Y-m-d")."&theatre=".implode("_", explode(" ", $theatre))."&time=".$time1."'>".$time1."</a>
                                            <div class='info'>".$res."</div>
                                        </li>";
                                }
                                else echo
                                    //disabled
                                    "<li class='time-cell disabled'>
                                        <a>".$time1."</a>
                                        <div class='info disabled'></div>
                                    </li>";
                            echo "</ul>";
                            break;
                        }
            }
            else{
                foreach($thetres as $theatre)
                    foreach($show as $date => $time){
                        if($date == $_GET['date'] && $date > date("Y-m-d")){ echo
                            "<h4 class='theatre'>".$theatre."</h4>
                            <ul class='timetable'>";
                                foreach($show[$date] as $time){
                                    $res = substr_count($film['occupied_seats'], $_GET['date']." ".implode("_", explode(" ", $theatre))." ".date("H:i", strtotime($time)));
                                    if($res > 95){ echo
                                        //disabled
                                        "<li class='time-cell disabled'>
                                            <a>".$time."</a>
                                            <div class='info'>SOLD OUT</div>
                                        </li>
                                    "; continue;}
                                    else if($res > 80) $res = "ALMOST FULL"; //max = 97
                                    else $res = "";
                                    echo
                                        //enabled
                                        "<li class='time-cell'>
                                            <a href='seats.php?id=".$film['id']."&date=".date("Y-m-d", strtotime($date))."&theatre=".implode("_", explode(" ", $theatre))."&time=".$time."'>".$time."</a>
                                            <div class='info'>".$res."</div>
                                        </li>";
                                }
                            echo "</ul>";
                        }
                    }
            }
        ?>
    </div>

    <div class="session_film">
        <div class="video">
            <div id="t_ytVideoCover" data-url="https://www.youtube.com/embed/<?php echo substr($film['trailer'], strpos($film['trailer'], "?") + 3); ?>?autoplay=1" style="background-image: url('<?php echo "./style/images/hero/".$film['id'].".jpg?t=".time(); ?>');">
                <div class="play-btn"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="icon_play" viewBox="0 0 45 45" preserveAspectRatio="xMidYMid meet" fill="#ffffff" width="100%" height="100%"> <path d="M22.5 0A22.5 22.5 0 1 0 45 22.5 22.5 22.5 0 0 0 22.5 0zm0 43.172A20.672 20.672 0 1 1 43.172 22.5 20.672 20.672 0 0 1 22.5 43.172z"></path> <path d="M19.181 13.331a.9.9 0 0 0-1.462.732v16.874a.9.9 0 0 0 1.462.732l11.616-8.438a.9.9 0 0 0 0-1.49zm.506 15.806V15.864l9 6.637z"></path></svg></div>
            </div>
        </div>
        <h2><?php echo $film['title']; ?></h2>
        <div class="info"><?php echo date('g', strtotime($film['duration']))." H ".date('i', strtotime($film['duration']))." MIN<span>|</span>".$film['rating']; ?></div>
    </div>
</div>



<script src="script/session.js"></script>
</body>
</html>



<!-- Notes -->
<!--
    Mark "ALMOST FULL" if not many seats left.
-->