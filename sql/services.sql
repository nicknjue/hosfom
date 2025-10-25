CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    cost DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Services
INSERT INTO services (service_name, Category, cost, description) VALUES
('X-Ray', 'Imaging', 5000, 'Chest and bone X-Ray'),
('MRI Scan', 'Imaging', 20000, 'Magnetic Resonance Imaging'),
('Blood Test', 'Lab', 1500, 'Complete Blood Count'),
('ECG', 'Diagnostics', 2000, 'Electrocardiogram test');