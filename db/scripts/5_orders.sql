CREATE TABLE orders
(
    id                  BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    customer_id         BIGINT,
    driver_id           BIGINT,
    first_address       VARCHAR(255) NOT NULL,
    destination_address VARCHAR(255) NOT NULL,

    FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE SET NULL,
    FOREIGN KEY (driver_id) REFERENCES drivers (id) ON DELETE SET NULL
);