<?php

require_once __DIR__ . "/../models/Load.php";

class LoadController
{
    private $load;

    public function __construct()
    {
        $this->load = new Load();
    }

    public function create($data)
    {
        return $this->load->create($data);
    }

    public function getLoadsByFarmer($farmer_id)
    {
        return $this->load->getLoadsByFarmer($farmer_id);
    }

    public function countTotalLoads($farmer_id)
    {
        return $this->load->countTotalLoads($farmer_id);
    }

    public function countLoadsByStatus($farmer_id, $status)
    {
        return $this->load->countLoadsByStatus($farmer_id, $status);
    }

    public function findById($id)
    {
        return $this->load->findById($id);
    }

    public function update($data)
    {
        return $this->load->update($data);
    }

    public function delete($id)
    {
        return $this->load->delete($id);
    }
}