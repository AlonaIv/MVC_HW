CREATE TABLE customers
(
    id      BIGINT PRIMARY KEY AUTO_INCREMENT,
    email   VARCHAR(150) NOT NULL UNIQUE,
    name    VARCHAR(50)  NOT NULL,
    surname VARCHAR(50)  NOT NULL
);