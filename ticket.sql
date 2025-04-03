CREATE DATABASE barcode_scanner;

USE barcode_scanner;

CREATE TABLE scanned_barcodes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barcode_id VARCHAR(255) UNIQUE NOT NULL,
    scan_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
