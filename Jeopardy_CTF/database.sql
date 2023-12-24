
create database ctf_db;
use ctf_db;


CREATE TABLE IF NOT EXISTS users (
    `userId` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `RE` INT DEFAULT 0,
    `WEB` INT DEFAULT 0,
    `CRYPTO` INT DEFAULT 0,
    `STEGO` INT DEFAULT 0,
    `points` INT DEFAULT 0,
    `challenge_timestamp` TIMESTAMP DEFAULT NULL
)engine=InnoDB;
DELIMITER //
CREATE TRIGGER calculate_completed
BEFORE UPDATE ON users FOR EACH ROW
BEGIN
    SET NEW.points = NEW.RE + NEW.WEB + NEW.CRYPTO + NEW.STEGO;


    SET NEW.challenge_timestamp= CURRENT_TIMESTAMP;
END;
//
DELIMITER ;
