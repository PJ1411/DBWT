@extends('emensa.layout.emensa_layout')

@section('header')
    <div id="logo"><a href="/">E-Mensa Logo</a> </div>
    <div id="header">
        <a>Anmeldung</a>
    </div>
    <div></div>
@endsection

@section('main')
    <h3>Anmeldung bei der E-Mensa</h3>
    <form action="anmeldung_verifizieren" method="POST">
        <label for="email">E-Mail</label>
        <input id="email" name="email" type="email" required> <br>
        <label for="email">Passwort </label>
        <input id="passwort" name="passwort" type="password" required> <br>
        <button type="submit">Anmelden</button>
    </form>

@endsection

@section('footer')
    <footer>
        <div>(c) E-Mensa GmbH</div>
        <div> Phillip Jansen & Thomas Nold </div>
        <div> <a href="https://www.fh-aachen.de/impressum/">Impressum</a></div>
    </footer>
@endsection