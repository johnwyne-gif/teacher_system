CREATE DATABASE teacher_system;
USE teacher_system;

-- USER TABLE (Login)
CREATE TABLE users (
    User_ID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255),
    Password VARCHAR(255),
    Role VARCHAR(20)
);

INSERT INTO users (Email, Password, Role) 
VALUES ('admin@gmail.com', '12345', 'admin');


-- DEPARTMENTS
CREATE TABLE department (
    Department_ID INT AUTO_INCREMENT PRIMARY KEY,
    Department_Name VARCHAR(255),
    Department_Code VARCHAR(50)
);

INSERT INTO department (Department_Name, Department_Code) VALUES
('Science','SCI'),
('Mathematics','MATH'),
('Humanities','HUM');

-- INSTRUCTORS
CREATE TABLE instructor (
    Instructor_ID INT AUTO_INCREMENT PRIMARY KEY,
    Last_Name VARCHAR(255),
    First_Name VARCHAR(255),
    Middle_Name VARCHAR(255),
    Gender VARCHAR(10),
    Birth_Date DATE,
    Email VARCHAR(255),
    Contact_Number VARCHAR(50),
    Address TEXT,
    Department_ID INT,
    Date_Hired DATE,
    FOREIGN KEY (Department_ID) REFERENCES department(Department_ID) ON DELETE SET NULL
);

-- QUALIFICATION (Education)
CREATE TABLE qualification (
    Qualification_ID INT AUTO_INCREMENT PRIMARY KEY,
    Instructor_ID INT,
    Degree VARCHAR(255),
    Institution VARCHAR(255),
    Graduation_Year YEAR,
    FOREIGN KEY (Instructor_ID) REFERENCES instructor(Instructor_ID) ON DELETE CASCADE
);

-- TEACHING LOADS
CREATE TABLE teaching_load (
    TeachingLoad_ID INT AUTO_INCREMENT PRIMARY KEY,
    Instructor_ID INT,
    Subject_Name VARCHAR(255),
    Semester VARCHAR(50),
    Academic_Year VARCHAR(20),
    FOREIGN KEY (Instructor_ID) REFERENCES instructor(Instructor_ID) ON DELETE CASCADE
);

-- EVALUATION
CREATE TABLE evaluation (
    Evaluation_ID INT AUTO_INCREMENT PRIMARY KEY,
    Instructor_ID INT,
    Semester VARCHAR(50),
    Academic_Year VARCHAR(20),
    Rating DECIMAL(3,2),
    FOREIGN KEY (Instructor_ID) REFERENCES instructor(Instructor_ID) ON DELETE CASCADE
);
