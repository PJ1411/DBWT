@extends('emensa.layout.emensa_layout')
<?php
?>

@section('header')
    <div id="logo"><a href="/homepage">E-Mensa Logo</a> </div>
    <div id="header">
        <a>Vegetarische Gerichte</a>
    </div>
    <div></div>
@endsection

@section('main')
    <div id="speisen"><h3>Kategorie mit Gerichten</h3>
        <table id="menue">
            <thead>
            <tr>
                <th>ID</th>
                <th>Kategorie</th>
                <th>Vegetarische Gerichte</th>
            </tr>
            </thead>
            <tbody>
            @foreach($kategorie as $row)
                <tr>
                    <td>{{$row['id']}}</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['group_concat(g.name)']}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection