<?php
session_start();
require_once "../../app/controllers/LoadController.php";
if(!isset($_SESSION['user'])){header("Location: ../login.php");exit;}
$user=$_SESSION['user'];
if(!isset($_GET['id'])) die("Invalid request.");
$c=new LoadController();
$load=$c->findById($_GET['id']);
if(!$load) die("Load not found.");
if($load['farmer_id']!=$user['id']) die("Access denied.");
if($load['status']!=="OPEN") die("Only OPEN loads can be edited.");

$errors=[];$success="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
$data=[
'id'=>$load['id'],
'crop_name'=>trim($_POST['crop_name']),
'quantity'=>trim($_POST['quantity']),
'unit'=>$_POST['unit'],
'vehicle_type'=>$_POST['vehicle_type'],
'pickup_state'=>trim($_POST['pickup_state']),
'pickup_district'=>trim($_POST['pickup_district']),
'pickup_taluka'=>trim($_POST['pickup_taluka']),
'pickup_village'=>trim($_POST['pickup_village']),
'destination_state'=>trim($_POST['destination_state']),
'destination_district'=>trim($_POST['destination_district']),
'destination_taluka'=>trim($_POST['destination_taluka']),
'destination_village'=>trim($_POST['destination_village']),
'expected_price'=>trim($_POST['expected_price'])?:None,
'pickup_date'=>$_POST['pickup_date'],
'description'=>trim($_POST['description'])
];
if($c->update($data)){header("Location: my-loads.php");exit;} else $errors[]="Update failed.";
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Edit Load</title><link rel="stylesheet" href="../css/dashboard.css"></head><body>
<div class="main-content"><h1>✏️ Edit Load</h1>
<form method="POST">
<input type="text" name="crop_name" value="<?=htmlspecialchars($load['crop_name'])?>" required>
<input type="number" step="0.01" name="quantity" value="<?=$load['quantity']?>" required>
<select name="unit">
<option value="KG" <?=$load['unit']=="KG"?"selected":""?>>KG</option>
<option value="QUINTAL" <?=$load['unit']=="QUINTAL"?"selected":""?>>QUINTAL</option>
<option value="TON" <?=$load['unit']=="TON"?"selected":""?>>TON</option>
</select>
<select name="vehicle_type">
<?php foreach(["PICKUP"=>"Pickup","TATA_407"=>"Tata 407","TRUCK"=>"Truck","CONTAINER"=>"Container"] as $k=>$v):?>
<option value="<?=$k?>" <?=$load['vehicle_type']==$k?"selected":""?>><?=$v?></option>
<?php endforeach;?>
</select>
<?php foreach(["pickup_state","pickup_district","pickup_taluka","pickup_village","destination_state","destination_district","destination_taluka","destination_village"] as $f):?>
<input type="text" name="<?=$f?>" value="<?=htmlspecialchars($load[$f])?>" required>
<?php endforeach;?>
<input type="number" step="0.01" name="expected_price" value="<?=$load['expected_price']?>">
<input type="date" name="pickup_date" value="<?=$load['pickup_date']?>" required>
<textarea name="description"><?=htmlspecialchars($load['description'])?></textarea>
<button type="submit">Update Load</button>
</form></div></body></html>