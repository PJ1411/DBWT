<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "kategorie"
 */
function db_kategorie_select_all() {
    $link = connectdb();

    $sql = "SELECT * FROM kategorie";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_kategorie_sortiert(){
    $data = db_kategorie_select_all();
    $getColumn = array_column($data,'name');
    array_multisort($getColumn,SORT_ASC,$data);
    return $data;

}

function getVegi(){
    $link = connectdb();
    $sql = "SELECT k.id, k.name,group_concat(g.name) FROM kategorie k left join gericht_hat_kategorie ghk on
    k.id = ghk.kategorie_id left join gericht g on ghk.gericht_id = g.id and g.vegetarisch=true group by k.id;";
    $result = mysqli_query($link,$sql);
    return $result;
}