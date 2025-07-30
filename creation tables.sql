CREATE TABLE
    user (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nom TINYTEXT,
        email VARCHAR(200) UNIQUE,
        password TEXT
    );

CREATE TABLE
    task (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name TINYTEXT,
        description TEXT,
        checked TINYINT(1),
        userId INT,
        FOREIGN KEY (userId) REFERENCES user (id)
    );