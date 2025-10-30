CREATE TABLE evaluations (
    eval_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    department_id INT NOT NULL,
    service_rating ENUM('Excellent','Good','Fair','Poor') NOT NULL,
    staff_behavior ENUM('Excellent','Good','Fair','Poor') NOT NULL,
    cleanliness ENUM('Excellent','Good','Fair','Poor') NOT NULL,
    comments TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(dept_id)
);