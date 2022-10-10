<?php
   if(!isset($_SESSION['benutzername']))
       {
           header("Refresh:1;url=http://localhost:9000/anmeldung");
       }
    ?>

@extends('emensa.layout.emensa_layout')

@section('header')
    <div id="logo"><a href="/">E-Mensa Logo</a> </div>
    <div id="header">
        <a>Bewertung</a>
        <a href="/meinebewertungen">Meine Bewertungen</a>
        @if($admin)
            <a href="/hervorheben">Hervorheben</a>
            <a href="/abwaehlen">Abwählen</a>
        @endif
    </div>
    <div></div>
@endsection

@section('main')
    <h3> Bewertung des Gerichts: {{$gericht['name']}}</h3>
    @if($gericht['bildname']==null)
        <img src="/img/00_image_missing.jpg" width="400" height="300">
    @else
        <img src="/img/{{$gericht['bildname']}}" width="400" height="300">
        @endif
    <br>

    <div id="container">
        <form action="/bewertung_verifizieren" method="POST" id="container">
            <div class="item"><label for="bemerkung"> Bemerkung</label></div>
            <div class="item"><textarea cols="40" rows="5" id="bemerkung" name="bemerkung" required></textarea></div>
            <div class="item"><label for="bewertung">Bewertung</label></div>
            <div class="item"><select id="bewertung" name="bewertung" required>
                    <option>Sehr schlecht</option>
                    <option>Schlecht</option>
                    <option>Gut</option>
                    <option>Seht gut</option>
                </select></div>
            <div class="item"><input type="submit" value="Bewertung abschicken"></div>
        </form> </div>

    <table>
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
        <tr @if($row['hervorgehoben']) class="hervorgehoben" @endif>
            <td>{{$row['zeitpunkt']}}</td>
            <td>{{$row['name']}}</td>
            <td>{{$row['bemerkung']}}</td>
            <td>{{$row['sterne_bewertung']}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>

@endsection

@section('footer')
    <footer>
        <div>(c) E-Mensa GmbH</div>
        <div> Phillip Jansen & Thomas Nold </div>
        <div> <a href="https://www.fh-aachen.de/impressum/">Impressum</a></div>
    </footer>
@endsection
