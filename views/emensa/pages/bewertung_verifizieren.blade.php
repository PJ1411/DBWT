@if($bew==true)
    <?php
    echo "Erfolgreich Bewertet!";
    header("Refresh:3;url=http://localhost:9000/homepage");
    ?>
@else
    <?php
    echo "Es gab ein Fehler! Bitte erneut versuchen!";
    header("Refresh:3;url=http://localhost:9000/homepage");
    ?>
@endif
