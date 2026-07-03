CREATE TABLE loads (

    id BIGINT AUTO_INCREMENT PRIMARY KEY,

    farmer_id BIGINT NOT NULL,

    crop_name VARCHAR(100) NOT NULL,

    quantity DECIMAL(10,2) NOT NULL,

    unit ENUM('KG','QUINTAL','TON') NOT NULL,

    vehicle_type ENUM('PICKUP','TATA_407','TRUCK','CONTAINER') NOT NULL,

    pickup_state VARCHAR(100) NOT NULL,

    pickup_district VARCHAR(100) NOT NULL,

    pickup_taluka VARCHAR(100) NOT NULL,

    pickup_village VARCHAR(100) NOT NULL,

    destination_state VARCHAR(100) NOT NULL,

    destination_district VARCHAR(100) NOT NULL,

    destination_taluka VARCHAR(100) NOT NULL,

    destination_village VARCHAR(100) NOT NULL,

    expected_price DECIMAL(10,2) DEFAULT NULL,

    pickup_date DATE NOT NULL,

    description TEXT,

    status ENUM(
        'OPEN',
        'BOOKED',
        'IN_TRANSIT',
        'DELIVERED',
        'CANCELLED'
    ) DEFAULT 'OPEN',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_farmer
        FOREIGN KEY (farmer_id)
        REFERENCES users(id)
        ON DELETE CASCADE

);