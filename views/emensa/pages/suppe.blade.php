@extends('emensa.layout.emensa_layout')
<?php
    ?>

@section('header')
    <div id="logo"><a href="/homepage">E-Mensa Logo</a> </div>
    <div id="header">
        <a>Suppen</a>
    </div>
    <div></div>
@endsection

@section('main')
    <div id="speisen"><h3>Alle unsere Suppen</h3>
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

            @foreach($suppenGericht as $row)
                <tr>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['preis_intern']}}</td>
                    <td>{{$row['preis_extern']}}</td>
                    @if($row['group_concat(gha.code)']==null)
                        <td> ------  </td>
                    @else
                        <td>{{$row['group_concat(gha.code)']}}</td>
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
    </div>
@endsection

@section('footer')
    <footer>
        <div>(c) E-Mensa GmbH</div>
        <div> Phillip Jansen & Thomas Nold </div>
        <div> <a href="https://www.fh-aachen.de/impressum/">Impressum</a></div>
    </footer>
@endsection
