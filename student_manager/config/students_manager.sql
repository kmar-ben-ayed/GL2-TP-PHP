DROP DATABASE IF EXISTS students_manager;
CREATE DATABASE students_manager;
USE students_manager;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    role varchar(50) NOT NULL,	
    password VARCHAR(255) NOT NULL
);

CREATE TABLE sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(100) NOT NULL,
    description TEXT DEFAULT NULL
);

CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    birthday DATE,
    image VARCHAR(255) DEFAULT NULL,
    section INT DEFAULT NULL, 
    FOREIGN KEY (section) REFERENCES sections(id) ON DELETE SET NULL
);


INSERT INTO users (username, email, role, password) VALUES
('admin1', 'admin@example.com', 'admin', '1234'), 
('user1', 'user@example.com', 'user', '0000');

INSERT INTO sections (designation, description) VALUES
('GL', 'Génie Logiciel'),
('RT', 'Réseau et Télécommunication'),
('IIA', 'Informatique Industrille et Automatique'),
('IMI', 'Instrumentation et Maintenance Industrielle');

INSERT INTO students (name, birthday, image, section) VALUES
('Aymen', '1982-02-07', 'student_manager\includes\person.jpeg', 2), 
('Skander', '2018-07-11', 'student_manager\includes\person.jpeg', 3),
('Sarah', '2005-03-14', 'student_manager\includes\person.jpeg', 1),
('Kmar', '2004-07-11', 'student_manager\includes\person.jpeg', 1);
