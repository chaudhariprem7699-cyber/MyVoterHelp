CREATE DATABASE IF NOT EXISTS myvoterhelp;
USE myvoterhelp;

-- =========================
-- Admin Table
-- =========================
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Admin
INSERT INTO admins (username, full_name, email, password)
VALUES (
'prem',
'Prem Chaudhari',
'chaudhariprem7699@gmail.com',
'$2y$10$7mW7Q4D9ZQ1yJ5O7vA6bV.t9N9q4XQJq3M4wN2V7s8L5c1rJ0Qm7C'
);

-- =========================
-- User Registration
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mobile VARCHAR(15) NOT NULL,
    date_of_birth DATE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- Voter Applications
-- =========================
CREATE TABLE voter_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    aadhaar_no VARCHAR(20),
    address TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    pincode VARCHAR(10),
    photo VARCHAR(255),
    aadhaar_file VARCHAR(255),
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- Contact Messages
-- =========================
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150),
    subject VARCHAR(200),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- Birthday Email Logs
-- =========================
CREATE TABLE birthday_email_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    sent_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);