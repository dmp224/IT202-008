CREATE TABLE IF NOT EXISTS `OrderItems` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `order_id`    int,
    `product_id`    int,
    `quantity` INT DEFAULT 0,
    `unit_price` DECIMAL(10,2) DEFAULT 0.00,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`order_id`) REFERENCES Orders(`id`),
    FOREIGN KEY (`product_id`) REFERENCES Products(`id`),
)
