DROP DATABASE IF EXISTS pokedex;
CREATE DATABASE pokedex;
USE pokedex;

CREATE TABLE pokemon
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(255),
    type varchar(255),
    caught DATE

);

INSERT INTO pokemon(name, type, caught)
VALUES ('Geromon', 'testtier','2012.12.12'),
       ('Ahmadendon', 'testtier', '2015.10.31'),
       ('Atereadendon', 'tesdsfer', '2019.10.2'),
       ('Adsfmadendon', 'teder', '2015.1.3'),
       ('Asdason', 'tessadaaqtier', '2015.1.5'),
       ('xtendon', 'testtier', '2002.2.6');


