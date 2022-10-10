<?php
function getHash($password){
    return sha1("dbwt2020" . $password);
}
function anmeldungVer(){
    session_start();
    $passwort = trim($_POST['passwort']);
    $email = $_POST['email'];
    if(!empty($passwort)){
        $spam=['@rcpt.at','@damnthespam.at',"@wegwerfmail.de","@trashmail."];
        $i=true;
        if(isset($email)&& filter_var(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            foreach ($spam as $s) {
                if (strpos(strtolower($email), $s) == true) {
                    $_SESSION['benutzername'] = "Gast";
                    return false;
                }
            }
        }
        if($i==true){
            $link = connectdb();
            mysqli_begin_transaction($link);
            $PASSWORT = getHash($passwort);
            $numRows =0;
            try{
                $sql = "SELECT * FROM benutzer where email='$email' and passwort='$PASSWORT'";
                $result = mysqli_query($link,$sql);
                $numRows = mysqli_num_rows($result);
                mysqli_commit($link);
                mysqli_close($link);
            } catch (mysqli_sql_exception $e){
                mysqli_rollback($link);
            }
            if($numRows==0) {
                $link=connectdb();
                try{
                    $sql = "UPDATE benutzer set letzterfehler = NOW() where email='$email'";
                    mysqli_query($link, $sql);
                    mysqli_commit($link);
                } catch (mysqli_sql_exception $e){
                    mysqli_rollback($link);
                }
                mysqli_close($link);
                $_SESSION['benutzername'] = "Gast";
                return false;
            }else{
                $link = connectdb();
                try{
                    $sql = "UPDATE benutzer set letzteanmeldung = NOW() where email='$email'";
                    mysqli_query($link,$sql);
                    /* Mit normaler sql Abrage:
                    $sql1 = "UPDATE benutzer SET anzahlanmeldung = anzahlanmeldung+1 where email='$email' and passwort='$PASSWORT'";
                    */
                    /*Mit Prozedur: */
                    $sql1="CALL getID($email,@ID);";

                    mysqli_query($link,$sql1);
                    $sql2="CALL anmeldeAnzahlInc(@ID);";
                    mysqli_query($link,$sql2);
                    mysqli_commit($link);
                } catch (mysqli_sql_exception $e){
                    mysqli_rollback($link);
                }
                mysqli_close($link);
                $_SESSION['benutzername'] = $email;
                return true;
            }
        }

    } else{
        $_SESSION['benutzername'] = "Gast";
        return false;
    }
}

function getBenutzerAnm(){
    $link = connectdb();
    $sql = "SELECT * FROM benutzer ORDER BY anzahlanmeldung desc";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    return $result;
}

function bewVer(){
    if(isset($_POST['bemerkung'])){
        if(isset($_POST['bewertung'])){
            $bewertung = $_POST['bewertung'];
            $bemerkung = $_POST['bemerkung'];
            if(strlen($bemerkung)>4){
                session_start();
                if(isset($_SESSION['gerichtID'])&&isset($_SESSION['benutzername']))
                {
                    $link = connectdb();
                    $gerichtID = $_SESSION['gerichtID']['id'];
                    $email = $_SESSION['benutzername'];
                    $sql="SELECT id FROM benutzer where email = '$email'";
                    $result= mysqli_query($link,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $benutzerID = (int) $row['id'];
                    $SQL = "Insert INTO bewertung (benutzerID, gerichteID,bemerkung, sterne_bewertung, zeitpunkt) 
                        VALUES ('$benutzerID', '$gerichtID', '$bemerkung', '$bewertung', NOW())";
                    mysqli_query($link, $SQL);
                    mysqli_close($link);
                    return true;
                }else false;
            } else false;
        }else false;
    }else false;
}

function get30Bewertungen(){
    $link = connectdb();
    $SQL = "SELECT b.zeitpunkt, g.name, b.bemerkung, b.sterne_bewertung, b.hervorgehoben FROM bewertung b left join gericht g on b.gerichteID = g.id order by b.zeitpunkt desc limit 30;";
    $result = mysqli_query($link,$SQL);
    mysqli_close($link);
    return $result;
}

function meineBewertungen()
{
    $link = connectdb();
    if(!isset($_SESSION['benutzername']))
        session_start();
    $email = $_SESSION['benutzername'];
    $sql="SELECT id FROM benutzer where email = '$email'";
    $idResult = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($idResult);
    $id = (int) $row['id'];
    $sql = "SELECT b.id, b.zeitpunkt, g.name, b.bemerkung, b.sterne_bewertung, b.hervorgehoben FROM bewertung b join gericht g on b.gerichteID = g.id and b.benutzerID = '$id' ORDER BY zeitpunkt desc";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    return $result;
}


function bewertungLoeschen(){
    $link = connectdb();
    session_start();
    $email = $_SESSION['benutzername'];
    $sql="SELECT id FROM benutzer where email = '$email'";
    $idResult = mysqli_query($link,$sql);
    $idrow = mysqli_fetch_assoc($idResult);
    $id = (int) $idrow['id'];
    $sql = "SELECT b.id, b.zeitpunkt, g.name, b.bemerkung, b.sterne_bewertung, b.hervorgehoben FROM bewertung b left join gericht g on b.gerichteID = g.id and b.benutzerID = '$id' ORDER BY zeitpunkt desc";
    $bewertungen = mysqli_query($link,$sql);

    foreach ($bewertungen as $row)
    {
        if(isset($_POST[$row['id'].'Loeschen']))
        {
            $id = $row['id'];
            $sql = "DELETE FROM bewertung WHERE id = '$id'";
            mysqli_query($link,$sql);
        }
    }
    mysqli_close($link);
}

function getAdmin(){
    $link = connectdb();
    if(!isset($_SESSION['benutzername']))
        return false;
    $email = $_SESSION['benutzername'];
    $sql = "SELECT admin FROM benutzer where email = '$email'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $admin = (bool) $row['admin'];
    mysqli_close($link);
    return $admin;
}
function getBewertungen(){
    $link = connectdb();
    $SQL = "SELECT b.id, b.zeitpunkt, g.name, b.bemerkung, b.sterne_bewertung, b.hervorgehoben FROM bewertung b left join gericht g on b.gerichteID = g.id order by b.zeitpunkt";
    $result = mysqli_query($link,$SQL);
    mysqli_close($link);
    return $result;
}

function hervorheben(){
    $link = connectdb();
    $sql = "SELECT id, hervorgehoben FROM bewertung";
    $bewertungen = mysqli_query($link,$sql);

    foreach ($bewertungen as $row)
    {
        if(isset($_POST[$row['id'].'hervorheben']))
        {
            $id = $row['id'];
            $sql = "UPDATE bewertung set hervorgehoben = 1 WHERE id = '$id'";
            mysqli_query($link,$sql);
        }
    }
    mysqli_close($link);
}

function getHervorgehobene(){
    $link = connectdb();
    $SQL = "SELECT b.id, b.zeitpunkt, g.name, b.bemerkung, b.sterne_bewertung, b.hervorgehoben FROM bewertung b join gericht g on b.gerichteID = g.id and b.hervorgehoben=1 order by b.zeitpunkt";
    $result = mysqli_query($link,$SQL);
    mysqli_close($link);
    return $result;
}

function bewertungAbwaehlen(){
    $link = connectdb();
    $sql = "SELECT id, hervorgehoben FROM bewertung where hervorgehoben=1";
    $bewertungen = mysqli_query($link,$sql);

    foreach ($bewertungen as $row)
    {
        if(isset($_POST[$row['id'].'abwaehlen']))
        {
            $id = $row['id'];
            $sql = "UPDATE bewertung set hervorgehoben = 0 WHERE id = '$id'";
            mysqli_query($link,$sql);
        }
    }
    mysqli_close($link);
}

?>
