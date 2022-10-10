<?php
require_once('../models/gericht.php');
require_once('../models/kategorie.php');
require_once('../models/allergen.php');
require_once('../models/zahlen.php');
require_once('../models/benutzer.php');
require_once('../models/eloquent.php');

class emensaController
{


    public function hauptseite(){
        $logger = logger('/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/storage/logs/logsEmensa','logsEmensa');
        $logger->info('Homepage aufgerufen');
        $vars = [
            'gerichtAllergen' => db_gerichte_mit_allergene_ORM(),
            'allergen' => db_allergene(),
            'besucherZahlen' => get_besucher(),
            'anmeldeZahlen' => get_anmeldungen(),
            'gerichteZahlen' => count_gerichte(),
            'admin' => getAdmin(),
            'bewertung' => getBewertungen()
        ];

        return view('emensa.pages.hauptseite',$vars);
    }

    public function anmeldung(){
        $vars=['dummy' => 'dummy'];
        return view('emensa.pages.anmeldung',$vars);
    }
    public function anmeldung_verfizieren(){
        $anmeldung = anmeldungVer();
        $vars = [
            'anm' => $anmeldung
        ];
        if($anmeldung)
        {
            $user = $_SESSION['benutzername'];
            $logger = logger('/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/storage/logs/logsEmensa','logsEmensa');
            $logger->info("$user angemeldet!");
        }else{
            $logger = logger('/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/storage/logs/logsEmensa','logsEmensa');
            $logger->warning("Fehlgeschlagene Anmeldung");
        }

        return view('emensa.pages.anmeldung_verifizieren',$vars);
    }
    public function abmeldung(){
        $logger = logger('/Users/phillipjansen/Documents/DBWT/E-Mensa Werbeseite/emensa/storage/logs/logsEmensa','logsEmensa');
        session_start();
        if(isset($_SESSION['benutzername'])){
            $user = $_SESSION['benutzername'];
            $logger->info("$user abgemeldet!");
            $logger->info("Homepage aufgerufen");
        }
        session_destroy();
        $vars = [
            'gerichtAllergen' => db_gerichte_mit_allergene_ORM(),
            'allergen' => db_allergene(),
            'besucherZahlen' => get_besucher(),
            'anmeldeZahlen' => get_anmeldungen(),
            'gerichteZahlen' => count_gerichte(),
            'bewertung' => getBewertungen()
        ];

        return view('emensa.pages.hauptseite',$vars);
    }

    function suppen(){
        return view('emensa.pages.suppe',['suppenGericht'=>getSuppen()]);
    }

    function view_anmeldungen(){
        return view('emensa.pages.view_anmeldungen',['benutzer' => getBenutzerAnm()]);
    }

    function view_vegetarisch(){
        return view('emensa.pages.view_kategoriegerichte_vegetarisch',['kategorie'=> getVegi()]);
    }

    function bewertung(RequestData $rq){
        $vars = [
            //'gericht' => getGericht($rq->query['gerichtID']),
            'gericht' => getGericht_ORM($rq->query['gerichtID']),
            'bewertung' => get30Bewertungen(),
            'admin' => getAdmin(),
            'rq' => $rq
        ];
        return view('emensa.pages.bewertung', $vars);
    }

    function bewertung_verifizieren(){
        $vars=[
            'bew' =>bewVer()
        ];
        return view('emensa.pages.bewertung_verifizieren',$vars);
    }

    function meineBewertungen(){
        $vars = [
            'bewertung' => meineBewertungen()
        ];
        return view('emensa.pages.meinebewertungen',$vars);
    }

    function loeschen(){
        //bewertungLoeschen();
        bewertungLoeschen_ORM();
        $vars=[
            'bewertung' => meineBewertungen()
        ];
        return view('emensa.pages.meinebewertungen',$vars);
    }

    function adminHervorheben(){
        $vars=[
            'bewertung' => getBewertungen()
        ];
        return view('emensa.pages.hervorheben',$vars);
    }

    function bewertungHervorheben()
    {
        //hervorheben();
        aktHervorhebung_ORM();
        $vars=[
            'bewertung' => getBewertungen()
        ];
        return view('emensa.pages.hervorheben',$vars);
    }

    function abwaehlen(){
        $vars=[
            'bewertung' => getHervorgehobene()
        ];
        return view('emensa.pages.abwaehlen',$vars);
    }

    function bewertungAbwaehlen(){
        //bewertungAbwaehlen();
        aktAbwaelhen_ORM();
        $vars=[
            'bewertung' => getHervorgehobene()
        ];
        return view('emensa.pages.abwaehlen',$vars);
    }
    function admin(){
        $dummy=[];
        return view('emensa.pages.admin',$dummy);
    }
    function saveGericht(){
        gerichtSpeicher();
        $vars=[
            ];
        return view('emensa.pages.admin',$vars);
    }
}