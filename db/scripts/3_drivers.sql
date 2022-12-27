CREATE TABLE drivers
(
    id         BIGINT PRIMARY KEY AUTO_INCREMENT,
    cars_id    BIGINT,
    license_id VARCHAR(16)  NOT NULL UNIQUE,
    full_name  VARCHAR(150) NOT NULL,
    birthdate  DATE         NOT NULL,

    FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE SET NULL
);