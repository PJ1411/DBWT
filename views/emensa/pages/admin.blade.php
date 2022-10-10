@extends('emensa.layout.emensa_layout')

@section('header')
    <div id="logo"><a href="/">E-Mensa Logo</a> </div>
    <div id="header">
        <a href="/admin">Neues Gericht</a>
        <a href="/meinebewertungen">Meine Bewertungen</a>
        <a href="/hervorheben">Hervorheben</a>
        <a href="/abwaehlen">Abwählen</a>
    </div>
    <div></div>
@endsection

@section('main')
    <form method="POST" action="/saveGericht">
        <label for="gericht">Gerichtename:</label>
        <input id="gericht" name="gericht" type="text" required> <br>
        <label for="beschreibung">Beschreibung:
        <textarea id="beschreibung" name="beschreibung" rows="10" cols="50" required></textarea>
        </label> <br>
        <label> Vegan (ja/nein)
            <input type="text" name="vegan" required>
        </label> <br>
        <label> Vegetarisch (ja/nein)
            <input type="text" name="vegetarisch" required>
        </label> <br>
        <label for="preis_intern">Preis Intern:</label>
        <input id="preis_intern" name="preis_intern" type="number" step=".01" required> <br>
        <label for="preis_extern">Preis Extern:</label>
        <input id="preis_extern" name="preis_extern" type="number" step=".01"required> <br>
        <label>Bildname des Gerichts
            <input name="datei" type="text">
        </label> <br>
        <br>
        <input type="submit" value="Gericht abschicken">

    </form>
@endsection

@section('footer')
    <footer>
        <div>(c) E-Mensa GmbH</div>
        <div> Phillip Jansen & Thomas Nold </div>
        <div> <a href="https://www.fh-aachen.de/impressum/">Impressum</a></div>
    </footer>
@endsection