<?php
    $show_schedule = explode("\n", $film['show_schedule']);
    $show = [];
    foreach($show_schedule as $row){
        $pair = explode(' ', $row);
        if(array_key_exists($pair[0], $show)){
            array_push($show[$pair[0]], $pair[1]);
        } else {
            $show[$pair[0]] = [$pair[1]];
        }
    }
?>