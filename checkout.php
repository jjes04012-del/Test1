<?php
include 'config.php';

$product_id = $_POST['product_id'];
$amount = $_POST['amount'];
$secret_key = $_POST['secret_key'];

// Validate secret key
if($secret_key !== SANDBOX_SECRET_KEY){
    die("Invalid secret key!");
}

// Insert payment with status 'pending'
$stmt = $pdo->prepare("INSERT INTO payments (product_id, amount) VALUES (?, ?)");
$stmt->execute([$product_id, $amount]);
$payment_id = $pdo->lastInsertId();

// Redirect to success page
header("Location: success.php?payment_id=$payment_id");
exit;
?>
