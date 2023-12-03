DROP TABLE users;

CREATE TABLE users (
    id SERIAL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES 
('alice.smith', MD5('alicePass123')),
('bob.johnson', MD5('bobPass123')),
('carol.brown', MD5('carolPass123')),
('david.wilson', MD5('davidPass123')),
('emma.moore', MD5('emmaPass123')),
('frank.white', MD5('frankPass123')),
('grace.lee', MD5('gracePass123'));

