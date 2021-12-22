-- 1. feladat
CREATE DATABASE IF NOT EXISTS webshop DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

-- 3. feladat
ALTER TABLE szamlafej 
ADD FOREIGN KEY (vevoid) REFERENCES vevok(id);
ALTER TABLE szamlatetel 
ADD FOREIGN KEY (szamlafejid) REFERENCES szamlafej(id), 
ADD FOREIGN KEY (termekid) REFERENCES termekek(id);

-- 4. feladat
SELECT termekek.megnevezes, termekek.ar FROM termekek
ORDER BY termekek.ar ASC;

-- 5. feladat
UPDATE termekek
SET termekek.ar = termekek.ar * 0.95
WHERE termekek.ar > 5000;

-- 6. feladat
SELECT SUM(szamlatetel.mennyiseg * szamlatetel.bruttoegysegar) AS 'osszbevetel' FROM szamlatetel
INNER JOIN szamlafej ON szamlafejid = szamlafej.id
WHERE szamlafej.teljesites BETWEEN '2018.01.01' AND '2018.01.15';

-- 7. feladat
SELECT vevok.nev, vevok.telepules FROM vevok
LEFT JOIN szamlafej ON szamlafej.vevoid = vevok.id
WHERE szamlafej.kelt IS NULL
ORDER BY vevok.nev;

-- 8. feladat
SELECT termekek.megnevezes, SUM(szamlatetel.mennyiseg * szamlatetel.bruttoegysegar) AS 'bevetel' FROM szamlatetel
INNER JOIN termekek ON termekek.id = szamlatetel.termekid
GROUP BY termekek.megnevezes
ORDER BY bevetel DESC
LIMIT 3;