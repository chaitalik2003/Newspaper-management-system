CREATE DATABASE IF NOT EXISTS NewspaperManagement;
USE NewspaperManagement;

CREATE TABLE IF NOT EXISTS Admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE DATABASE IF NOT EXISTS NewspaperManagement;
USE NewspaperManagement;

CREATE TABLE IF NOT EXISTS Customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    subscription_start DATE NOT NULL,
    subscription_end DATE NOT NULL,
    newspaper VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS PaperHawkers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    contact VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS Deliveries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    hawker_id INT NOT NULL,
    date DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customers(id),
    FOREIGN KEY (hawker_id) REFERENCES PaperHawkers(id)
);

CREATE TABLE IF NOT EXISTS Invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    issue_date DATE NOT NULL,
    due_date DATE NOT NULL,
    newspaper VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    pending_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customers(id)
);

CREATE TABLE IF NOT EXISTS Reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_date DATE NOT NULL,
    total_deliveries INT NOT NULL,
    successful_deliveries INT NOT NULL,
    missed_deliveries INT NOT NULL,
    delays INT NOT NULL
);
