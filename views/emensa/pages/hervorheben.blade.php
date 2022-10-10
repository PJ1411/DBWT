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
    <h3> Gerichte Hervorheben</h3>
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
        <form action="/bewertungHervorheben" method="POST">
        @foreach($bewertung as $row)
            @if($row['hervorgehoben']==false)
            <tr>
                <td>{{$row['zeitpunkt']}}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['bemerkung']}}</td>
                <td>{{$row['sterne_bewertung']}}</td>
                <td><input type="checkbox" name="{{$row['id']}}hervorheben"></td>
            </tr>
                @endif
        @endforeach
            <input type="submit" value="Hervorheben">
        </form>
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