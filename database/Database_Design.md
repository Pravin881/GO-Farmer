# GO-Farmer Database Design

**Version:** 1.0

---

# Table: farmers

| Column | Data Type | Constraints | Description |
|---------|-----------|------------|-------------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | Unique farmer ID |
| full_name | VARCHAR(100) | NOT NULL | Farmer's full name |
| mobile_number | VARCHAR(10) | UNIQUE, NOT NULL | Login mobile number |
| password | VARCHAR(255) | NOT NULL | Hashed password |
| state | VARCHAR(100) | NOT NULL | State |
| district | VARCHAR(100) | NOT NULL | District |
| taluka | VARCHAR(100) | NOT NULL | Taluka |
| village | VARCHAR(100) | NOT NULL | Village |
| is_mobile_verified | BOOLEAN | DEFAULT FALSE | OTP verification status |
| account_status | ENUM('ACTIVE','INACTIVE','BLOCKED') | DEFAULT 'ACTIVE' | Account status |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Account creation time |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | Last update time |