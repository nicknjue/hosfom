CREATE TABLE departments (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL UNIQUE
);

-- Departments
INSERT INTO departments (dept_name) VALUES
('Cardiology'),
('Neurology'),
('Pediatrics'),
('Radiology'),
('Oncology');