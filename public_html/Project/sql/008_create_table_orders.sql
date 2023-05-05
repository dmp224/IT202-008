CREATE TABLE IF NOT EXISTS `Orders` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id`    int,
    `total_price` DECIMAL(10,2) DEFAULT 0.00,
    `address` varchar(200) default '',
    `payment_method` ENUM('Cash', 'Visa', 'MasterCard', 'Amex') DEFAULT 'cash',  
    `money_received` DECIMAL(10,2) DEFAULT 0.00,  
    `first_name` varchar(100) default '', 
    `last_name` varchar(100) default '', 
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES Users(`id`)
)
