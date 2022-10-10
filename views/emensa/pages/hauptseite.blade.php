@extends('emensa.layout.emensa_layout')
<?php
    if(!isset($_GET['show_allergen'])){
        $_GET['show_allergen'] =0;
    }
    session_start();
    if(isset($_SESSION['benutzername'])){
        $benutzername = $_SESSION['benutzername'];
        $admin = getAdmin();
    } else{
        $benutzername = "Gast";
    }
    ?>

@section('header')
    <div id="logo"><a href="#header"><br>E-Mensa Logo</a> </div>
    <div id="header">
        <a href="#ankündigung"><br>Ankündigung</a>
        <a href="#speisen"> Speisen</a>
        <a href="#zahlen">Zahlen</a>
        <a href="#meinung">Meinung unserer Gäste</a>
        <a href="#kontakt">Kontakt</a>
        <a href="#wichtig">Wichtig für uns</a>
    </div>
    <div id="nutzer">
        <ul id="nutzerList">
            <li>Angemeldet als: <?php echo $benutzername; ?></li>
            @if($benutzername =="Gast")
                    <li><a href="/anmeldung">Anmelden</a></li>
            @else
                <li><a href="/abmeldung">Abmelden</a></li>
                @if($admin)
                    <li><a href="/admin">Admin Seite</a></li>
                @endif
            @endif
        </ul>
    </div>
@endsection

@section('main')
    <div id="ankündigung"><h3>Bald gibts Essen auch online</h3></div>
    <div><p id="tank"> abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc. abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.abskjhcbaschsa asasdsdaas . ashba ahsbahb chabc hasbcahbsc,ahjbs as .ass a ashab
            zab bahsbazcab chabsc.
        </p>
    </div>


    <div id="speisen"><h3>Köstlichkeiten, die Sie erwarten</h3>
        <table id="menue">
            <thead>
            <tr>
                <th>Gericht</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergen</th>
                <th>Das Gericht</th>
            </tr>
            </thead>
            <tbody>

            @foreach($gerichtAllergen as $row)
                <tr>
                    <td><a href="/bewertung?gerichtID={{$row['id']}}">{{$row['name']}} </a></td>
                    <!--<td>{{$row['preis_intern']}}</td>-->
                    <td>{{$row->preis_intern}}</td>
                    <td>{{$row['preis_extern']}}</td>
                    @if($row['code']==null)
                        <td> ------  </td>
                    @else
                        <!--<td>{{$row['group_concat(gha.code)']}}</td>-->
                        <td>{{$row['code']}}</td>
                    @endif
                    @if($row['bildname']==null)
                        <td><img src="/img/00_image_missing.jpg" alt="immage_missing" width="100px" height="100px"></td>
                    @else
                        <td><img src="/img/{{$row['bildname']}}" width="100px" height="100px"></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Toggelt die anzeige von Allergen
               1: Allergen wird gezeigt
               0: allergen wird versteckt-->
        <h3 id="allergen">Allergen</h3>
        <form method="get" action="#allergen">
            <?php if($_GET['show_allergen']==0) {?>
            <input type="hidden" name="show_allergen" value="1">
            <?php } if($_GET['show_allergen']==1) { ?>
            <input type="hidden" name="show_allergen" value="0">
            <?php } ?>
            <input type="submit" value="Anzeigen/Ausblenden">
        </form>


        @if($_GET['show_allergen'] ==1)
        <table>
            <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Typ</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($allergen as $row)
                <tr>
                    <td>{{$row['code']}}</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['typ']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
        <h3>Ihr Wunschgericht</h3>
        <a href="wunschgericht.php"> Schicken Sie uns Ihr eigenes Wunschgericht ein!</a>
    </div>

    <div id="zahlen"><h3> E-Mensa in Zahlen</h3></div>
    <div> {{$besucherZahlen}}  Besucher | {{$anmeldeZahlen}} Anmeldungen |  {{$gerichteZahlen}} Speisen</div>

    <div id="meinung"><h3>Meinungen unserer Gäste</h3></div>
    <div><table>
            <thead>
            <tr>
                <th>Zeitpunkt</th>
                <th>Gerichtsname</th>
                <th>Bemerkung</th>
                <th>Sterne-Bewertung</th>
            </tr>
            </thead>
            <tbody>
                @foreach($bewertung as $row)
                    <tr>
                        <td>{{$row['zeitpunkt']}}</td>
                        <td>{{$row['name']}}</td>
                        <td>{{$row['bemerkung']}}</td>
                        <td>{{$row['sterne_bewertung']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table></div>

    <h3>Interesse geweckt? Wir Informieren Sie!</h3>
    <form id="kontakt" method="POST" action="formdata.php">
        <div id="kontakt-grid">
            <label for="name" > Ihr Name</label>
            <label for="email">Ihre E-Mail</label>
            <label for="news">Newsletter bitte in:</label>
            <input type="text" id="name" name="name" placeholder="Vorname" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <select name="news" id="news" required>
                <option> Deutsch </option>
                <option> English </option>
            </select>

        </div>
        <div id="kontakt-inline">
            <input type="checkbox" id="agb" name="agb" required>
            <label for="agb">Den Datenschutzbestimmungen stimme ich zu</label>
            <button type="submit" id="sub">Zum Newsletter anmelden</button>
        </div>
    </form>

    <div id="wichtig"><h3>Das ist uns wichtig</h3>
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
@endsection

@section('footer')
    <footer>
        <div>(c) E-Mensa GmbH</div>
        <div> Phillip Jansen & Thomas Nold </div>
        <div> <a href="https://www.fh-aachen.de/impressum/">Impressum</a></div>
    </footer>
@endsection