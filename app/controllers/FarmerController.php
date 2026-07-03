<?php

require_once __DIR__ . "/../models/User.php";

class FarmerController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register($data)
    {
        if ($this->user->mobileExists($data['mobile_number'])) {
            return [
                'success' => false,
                'message' => 'Mobile number already registered.'
            ];
        }

        $this->user->createFarmer($data);

        return [
            'success' => true,
            'message' => 'Farmer registered successfully.'
        ];
    }
}