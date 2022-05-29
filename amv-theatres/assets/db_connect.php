<?php
    $conn = mysqli_connect('localhost', 'noto', 'test1234', 'amv cinema');
    if(!$conn) echo 'Connection error' . mysqli_connect_error();
?>