<?php

require_once __DIR__ . "/../../config/database.php";

class User
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function mobileExists($mobile_number)
    {
        $query = "SELECT id FROM users WHERE mobile_number = :mobile_number";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":mobile_number", $mobile_number);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function createFarmer($data)
    {
        $query = "INSERT INTO users
        (
            role,
            full_name,
            mobile_number,
            password,
            state,
            district,
            taluka,
            village
        )

        VALUES
        (
            :role,
            :full_name,
            :mobile_number,
            :password,
            :state,
            :district,
            :taluka,
            :village
        )";

        $statement = $this->connection->prepare($query);

        return $statement->execute([

            ':role' => 'FARMER',
            ':full_name' => $data['full_name'],
            ':mobile_number' => $data['mobile_number'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':state' => $data['state'],
            ':district' => $data['district'],
            ':taluka' => $data['taluka'],
            ':village' => $data['village']

        ]);
    }

    public function findByMobile($mobile_number)
    {
        $query = "SELECT * FROM users WHERE mobile_number = :mobile_number LIMIT 1";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":mobile_number", $mobile_number);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}