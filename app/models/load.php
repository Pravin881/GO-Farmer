<?php

require_once __DIR__ . "/../../config/database.php";

class Load
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function create($data)
    {
        $query = "INSERT INTO loads
        (
            farmer_id,
            crop_name,
            quantity,
            unit,
            vehicle_type,
            pickup_state,
            pickup_district,
            pickup_taluka,
            pickup_village,
            destination_state,
            destination_district,
            destination_taluka,
            destination_village,
            expected_price,
            pickup_date,
            description
        )

        VALUES
        (
            :farmer_id,
            :crop_name,
            :quantity,
            :unit,
            :vehicle_type,
            :pickup_state,
            :pickup_district,
            :pickup_taluka,
            :pickup_village,
            :destination_state,
            :destination_district,
            :destination_taluka,
            :destination_village,
            :expected_price,
            :pickup_date,
            :description
        )";

        $statement = $this->connection->prepare($query);

        return $statement->execute($data);
    }

    public function getLoadsByFarmer($farmer_id)
    {
        $query = "SELECT * FROM loads
                  WHERE farmer_id = :farmer_id
                  ORDER BY created_at DESC";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":farmer_id", $farmer_id);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countLoadsByStatus($farmer_id, $status)
    {
        $query = "SELECT COUNT(*) AS total
                  FROM loads
                  WHERE farmer_id = :farmer_id
                  AND status = :status";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":farmer_id", $farmer_id);
        $statement->bindParam(":status", $status);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countTotalLoads($farmer_id)
    {
        $query = "SELECT COUNT(*) AS total
                  FROM loads
                  WHERE farmer_id = :farmer_id";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":farmer_id", $farmer_id);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function findById($id)
    {
        $query = "SELECT * FROM loads WHERE id = :id LIMIT 1";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":id", $id);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $query = "UPDATE loads SET

            crop_name = :crop_name,
            quantity = :quantity,
            unit = :unit,
            vehicle_type = :vehicle_type,
            pickup_state = :pickup_state,
            pickup_district = :pickup_district,
            pickup_taluka = :pickup_taluka,
            pickup_village = :pickup_village,
            destination_state = :destination_state,
            destination_district = :destination_district,
            destination_taluka = :destination_taluka,
            destination_village = :destination_village,
            expected_price = :expected_price,
            pickup_date = :pickup_date,
            description = :description

            WHERE id = :id";

        $statement = $this->connection->prepare($query);

        return $statement->execute($data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM loads WHERE id = :id";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(":id", $id);

        return $statement->execute();
    }
}