CREATE TABLE parks
(
    id            INT PRIMARY KEY AUTO_INCREMENT,
    serial_number VARCHAR(16)  NOT NULL UNIQUE,
    address       VARCHAR(255) NOT NULL
);