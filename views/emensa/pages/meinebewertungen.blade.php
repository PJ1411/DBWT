@extends('emensa.layout.emensa_layout')

@section('header')
    <div id="logo"><a href="/">E-Mensa Logo</a> </div>
    <div id="header">
        <a>Meine Bewertungen</a>
    </div>
    <div></div>
@endsection

@section('main')
    <h3> MeineBewertungen</h3>
    <table>
        <thead>
        <tr>
            <th>Zeitpunkt</th>
            <th>Gerichtsname</th>
            <th>Bemerkung</th>
            <th>Sterne-Bewertung</th>
            <th>Markieren</th>
        </tr>
        </thead>
        <tbody>
        <form action="/bewertungLoeschen" method="POST">
            @foreach($bewertung as $row)
                <tr>
                    <td>{{$row['zeitpunkt']}}</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['bemerkung']}}</td>
                    <td>{{$row['sterne_bewertung']}}</td>
                    <td><input type="checkbox" name="{{$row['id']}}Loeschen"></td>
                </tr>
            @endforeach
            <input type="submit" value="Löschen">
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
