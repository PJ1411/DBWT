@extends('emensa.layout.emensa_layout')
<?php
?>

@section('header')
    <div id="logo"><a href="/homepage">E-Mensa Logo</a> </div>
    <div id="header">
        <a>Anzahl der Anmeldungen</a>
    </div>
    <div></div>
@endsection

@section('main')
    <div id="speisen"><h3>Anmeldezahlen</h3>
        <table id="menue">
            <thead>
            <tr>
                <th>ID</th>
                <th>E-Mail</th>
                <th>letze Anmeldung</th>
                <th>Anzahl Anmeldungen</th>
            </tr>
            </thead>
            <tbody>
            @foreach($benutzer as $row)
                <tr>
                    <td>{{$row['id']}}</td>
                    <td>{{$row['email']}}</td>
                    <td>{{$row['letzteanmeldung']}}</td>
                    <td>{{$row['anzahlanmeldung']}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
