CREATE DATABASE hr_reports;
USE hr_reports;

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    incident_date DATE NOT NULL,
    reporter_name VARCHAR(255) NOT NULL,
    reporter_email VARCHAR(255) NOT NULL,
    incident_description TEXT NOT NULL,
    witnesses VARCHAR(255),
    created_at DATETIME NOT NULL,
    status ENUM('pending', 'in_progress', 'resolved') DEFAULT 'pending'
);