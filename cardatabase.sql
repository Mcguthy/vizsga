CREATE TABLE car_articles(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    car_name VARCHAR(60) NOT NULL,
    price VARCHAR(15),
    location VARCHAR(40),
    phone_number VARCHAR(20),
    description LONGTEXT,
    picture TEXT
)

INSERT INTO car_articles (car_name, price, location, phone_number, description, picture) values ("Szakadt Munkásautó", "200000 ft", "Kiskunfélegyháza", "+491607580674", "Egy Szerény Épitkezési Munkákra használt Autó ami új gazdáját keresi. 1.2es Motor kemény 65 lóerövel. A Felfüggesztés hagy kívanní valót. Müszaki és Forgalmi nincs.", "img/car1.jpg");
INSERT INTO car_articles (car_name, price, location, phone_number, description, picture) values ("Veretős Bömbi", "800000 ft", "Ózd", "+4915145839062", "Egy 2002-es BMW E36 318i Hegesztett Difivel és Rövidebbre vágott rúgókkal. Az üléshuzaton cigaretta által okozott égésnyomok vannak. Érvényes Műszaki vizsgával rendelkezik de öt megyében elfogatóparancs van az autó után.", "img/car2.jpg");
INSERT INTO car_articles (car_name, price, location, phone_number, description, picture) values ("EZ EGY SPORTAUTÓ ANYA", "20000000 ft", "Budapest III. Kerület", "+36 9210831", "Egy Webfejlesztő Törött Audi TTje. A Tulaj Két Biciglissel való versenyzés közben karambolozott vele az Árpád-hídon. Motort, Váltót, és a teljes Első felfüggesztést cserélni kell.", "img/car3.jpg");

CREATE TABLE shop_users(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(250) NOT NULL,
    password VARCHAR(250) NOT NULL
)

INSERT INTO shop_users (username, password) values ("Admin1", "$2y$10$8AZL6rylT9fQmqtNlp8ObuIk33rn.VuSJlECp3jNlLQcIxlStM8Ze");