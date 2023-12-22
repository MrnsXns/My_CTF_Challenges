
create database ctf_db;
use ctf_db;


CREATE TABLE IF NOT EXISTS users (
    `userId` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `RE` BOOLEAN NOT NULL,
    `WEB` BOOLEAN NOT NULL,
    `CRYPTO` BOOLEAN NOT NULL,
    `STEGO` BOOLEAN NOT NULL,
    `completed` FLOAT(3,2),
    `challenge_timestamp` TIMESTAMP DEFAULT NULL
)engine=InnoDB;
DELIMITER //
CREATE TRIGGER calculate_completed
BEFORE UPDATE ON users FOR EACH ROW
BEGIN
    SET NEW.completed = IFNULL(NEW.RE, 0) + IFNULL(NEW.WEB, 0) + IFNULL(NEW.CRYPTO, 0) + IFNULL(NEW.STEGO, 0);
    SET NEW.completed = NEW.completed * 0.25 ;

    SET NEW.challenge_timestamp= CURRENT_TIMESTAMP;
END;
//
DELIMITER ;
