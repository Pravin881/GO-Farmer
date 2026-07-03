<?php

session_start();

require_once "../../app/controllers/LoadController.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

if (!isset($_GET['id'])) {
    header("Location: my-loads.php");
    exit;
}

$controller = new LoadController();

$load = $controller->findById($_GET['id']);

if (!$load) {
    die("Load not found.");
}

if ($load['farmer_id'] != $user['id']) {
    die("Access Denied.");
}

if ($load['status'] != "OPEN") {
    die("Only OPEN loads can be deleted.");
}

$controller->delete($load['id']);

header("Location: my-loads.php");
exit;