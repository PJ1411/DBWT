<?php

function db_allergene(){
    $link = connectdb();
    $sql = "SELECT code,name,typ FROM allergen ORDER BY code asc";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);

    return $data;
}
