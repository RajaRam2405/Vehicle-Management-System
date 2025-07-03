-- SQL script to create User Login Module database schema

CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'staff') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    UNIQUE KEY unique_username (username),
    UNIQUE KEY unique_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS PasswordReset (
    reset_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    reset_token VARCHAR(255) NOT NULL UNIQUE,
    reset_requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reset_expires_at TIMESTAMP NOT NULL,
    reset_status ENUM('pending', 'completed') NOT NULL DEFAULT 'pending',
    INDEX idx_user_id (user_id),
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample queries for user authentication

-- Insert new user (password should be hashed with bcrypt in application)
-- INSERT INTO Users (username, email, password, role) VALUES (?, ?, ?, ?);

-- Update user password
-- UPDATE Users SET password = ? WHERE user_id = ?;

-- Validate user login by email or username and password hash
-- SELECT user_id, username, email, role, status FROM Users WHERE (email = ? OR username = ?) AND status = 'active';

-- Insert password reset request
-- INSERT INTO PasswordReset (user_id, reset_token, reset_expires_at) VALUES (?, ?, ?);

-- Update password reset status
-- UPDATE PasswordReset SET reset_status = 'completed' WHERE reset_token = ?;
ALTER TABLE bookings ADD COLUMN user_id INT NOT NULL AFTER id;
ALTER TABLE service_requests ADD COLUMN user_id INT NOT NULL AFTER id;
ALTER TABLE bookings ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
ALTER TABLE service_requests ADD CONSTRAINT fk_sr_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;