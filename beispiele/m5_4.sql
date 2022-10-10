/*1) */
CREATE VIEW suppen_gerichte AS
SELECT g.name, g.preis_intern, g.preis_extern, g.bildname, group_concat(gha.code) FROM gericht_hat_allergen gha
    right join gericht g on g.id = gha.gericht_id where g.name like '%suppe%' group by g.id;

SELECT * FROM suppen_gerichte;

/*2) */
CREATE VIEW view_anmeldung AS
SELECT * FROM benutzer ORDER BY anzahlanmeldung desc;

SELECT * from view_anmeldung;

/*3) */
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT k.id, k.name,group_concat(g.name) FROM kategorie k left join gericht_hat_kategorie ghk on
    k.id = ghk.kategorie_id left join gericht g on ghk.gericht_id = g.id and g.vegetarisch=true group by k.id;

SELECT  * FROM view_kategoriegerichte_vegetarisch;