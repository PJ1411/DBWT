create table if not exists bewertung(
    id int(8) primary key auto_increment,
    benutzerID int(8) not null references benutzer(id),
    gerichteID int(8) not null references gericht(id),
    bemerkung varchar(800) check ( bemerkung > 4 ),
    sterne_bewertung varchar(50) not null,
    hervorgehoben boolean default false
);