<?php

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>E-Mensa</title>
    <style type="text/css">

    </style>
</head>
<body>
@if($empty)
    Es sind keine Gerichte vorhanden
@else
    <table id="gericht" border="solid">
        <thead>
        <th>id</th>
        <th>name</th>
        <th>interner preis</th>
        </thead>
        <tbody>
        @foreach($data as $eintrag)
            <tr>
                <td> {{$eintrag['id']}}</td>
                <td> {{$eintrag['name']}}</td>
                <td> {{$eintrag['preis_intern']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</body>
</html>
