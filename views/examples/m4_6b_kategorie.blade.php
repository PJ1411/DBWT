
<!DOCTYPE html>
<html lang="de">
<head>
    <title>E-Mensa</title>
    <style type="text/css">
        tr:nth-child(even){
            font-weight: bold;
        }
    </style>
</head>
<body>

<table id="gericht" border="solid">
    <thead>
        <th>id</th>
        <th>name</th>
    </thead>
    <tbody>
    @foreach($data as $eintrag)
         <tr>
             <td> {{$eintrag['id']}}</td>
             <td> {{$eintrag['name']}}</td>
         </tr>
    @endforeach
    <tr></tr>
    </tbody>

</table>
</body>
</html>

