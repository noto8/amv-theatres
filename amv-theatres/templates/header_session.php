<header class="alt">
    <?php require "templates/header_alt_topCont.php"; ?>
    <ul class="th">
        <li>
            <label for="session_select"><span id="session_select_label"><?php if($_GET['date'] == date("Y-m-d")) echo "Today"; else echo date("D, M d", strtotime($_GET['date'])); ?></span><img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg" alt=""></label>
            <form action="" method="">
                <select name="days" id="session_select" onchange="location = 'session.php?id=' + <?php echo $film['id']; ?> + '&date=' + this.value">
                    <?php
                        if(array_key_exists(date("Y-m-d"), $show))
                            foreach($show[date("Y-m-d")] as $time)
                                    if(strtotime($time) > strtotime(date("H:i"))){ echo "<option value='".date("Y-m-d")."'>Today</option>"; break; }
                        foreach($show as $date => $time)
                            if(date(strtotime($date)) > strtotime(date("Y-m-d"))){
                                echo "<option value='".date("Y-m-d", strtotime($date))."' ";
                                if(date("Y-m-d", strtotime($date)) == $_GET['date']) echo "selected='selected'";
                                echo ">".date("D, M d", strtotime($date))."</option>";
                            }
                    ?>
                </select>
            </form>
        </li>
    </ul>
</header>