<?php
    $arr = [
        "2022-05-22 142_N_Ironside_Way_W 23:30 A16",
        "2022-05-22 142_N_Ironside_Way_W 23:30 A15",
        "2022-05-22 142_N_Ironside_Way_W 23:30 A14",
        "2022-05-22 142_N_Ironside_Way_W 23:30 A13",
        "2022-05-22 142_N_Ironside_Way_W 23:30 A12",
        "2022-05-22 142_N_Ironside_Way_W 23:30 A11",
        "2022-05-22 142_N_Ironside_Way_W 23:30 A10"
    ];
    $theatre = "142 N Ironside Way W";
    $time = "23:30";
    echo substr_count(implode("\r\n", $arr), $_GET['date']." ".implode("_", explode(" ", $theatre))." ".$time);
?>