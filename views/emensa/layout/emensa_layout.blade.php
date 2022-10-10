<?php
/**
 * Praktikum DBWT. Autoren:
 * Phillip, Jansen, 3234273
 * Thomas, Nold, 3030257
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Mensa</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
</head>
<body>
<div id="grid">
    @section('header')
        @show
    <div class="border"><hr></div>
    <div class="border"><hr> </div>
    <div class="border"><hr></div>
    <div></div>
    <div id="einträge">@section('main')
    @show</div>
</div>
<hr>
@section('footer')
    @show
</body>
</html>
