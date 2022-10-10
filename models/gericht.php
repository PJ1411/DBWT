<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    $link = connectdb();

    $sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_gericht_t2()
{
    $link = connectdb();

    $sql = "SELECT id, name, preis_intern FROM gericht where preis_intern>2 ORDER BY name desc ";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function check_if_gericht_empty()
{
    $link = connectdb();

    $sql = "SELECT id, name, preis_intern FROM gericht where preis_intern>2 ORDER BY name";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(!$row) {
        return true;
    } else {
        return false;
    }
}

function db_gerichte_mit_allergene(){
    $link = connectdb();
    $sql ="SELECT g.id, g.name, g.preis_intern, g.preis_extern, g.bildname, group_concat(gha.code) FROM gericht g 
                    left join gericht_hat_allergen gha on g.id = gha.gericht_id group by g.id ORDER BY g.name asc";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}

function txt_gericht(){
    $anfang=true;
    $datei= fopen("/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/public/zahlen/gerichte.txt","r");
    $countSpeisen=0;
    $i = 0;
    while($zeile = fgets($datei,4096))
    {
        if($i==3){
            echo "<td> ------</td>";
            $i++;
        }
        if($i==0){
            echo "<tr> <td>" .htmlspecialchars($zeile) ."</td>";
            $anfang=false;
            $i++;
            continue;
        } else if($i==4){
            echo"<td> <img src='img/$zeile'  width='500px' height='300px'> </td> </tr>";
            $anfang=true;
            $i=0;
            $countSpeisen++;
            continue;
        }
        echo "<td>" .htmlspecialchars($zeile). "</td>";
        $i++;
    }
}

function getSuppen(){
    $link = connectdb();
    $sql = "SELECT g.name, g.preis_intern, g.preis_extern, g.bildname, group_concat(gha.code) FROM gericht_hat_allergen gha
right join gericht g on g.id = gha.gericht_id where g.name like '%suppe%' group by g.id;";
    $result = mysqli_query($link,$sql);
    return $result;
}

function getGericht($gerichtID){
    $idInt = intval($gerichtID);

    $link = connectdb();
    $sql = "SELECT id, name, bildname FROM gericht where id=$gerichtID";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);

    session_start();
    $_SESSION['gerichtID'] = $row['id'];
    return $row;
}
