<?php

function get_besucher(){
    $besucher = fopen('/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/public/zahlen/besucher.txt',"a+");
    $count =0;
    while(fgets($besucher,4096)){
        $count++;
    }
    $neuer_besucher = $count+1 ."; " .$_SERVER['REMOTE_ADDR'] ."\r\n";
    fwrite($besucher,$neuer_besucher);
    fclose($besucher);
    return $count+1;
}

function get_anmeldungen(){
    $interessenten = unserialize(file_get_contents('/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/public/zahlen/newsletter.txt'));
    $countNLA = count($interessenten);
    return $countNLA;
}

function count_gerichte(){
    $datei= fopen("/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/public/zahlen/gerichte.txt","r");
    $countSpeisen=0;
    $i = 0;
    while($zeile = fgets($datei,4096)){
        $i++;
        if($i==4){
            $countSpeisen++;
            $i=0;
        }
    }
    fclose($datei);
    $link = connectdb();
    $sql = "SELECT * from gericht ";
    $result = mysqli_query($link, $sql);
    $rows   = mysqli_num_rows($result);
    mysqli_close($link);
    $RESULT = $rows + $countSpeisen;
    return $RESULT;
}
