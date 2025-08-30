<?php
include 'config.php';

$payment_id = $_GET['payment_id'] ?? 0;

// Update payment to 'paid'
$stmt = $pdo->prepare("UPDATE payments SET status='paid' WHERE payment_id=?");
$stmt->execute([$payment_id]);

// Fetch payment info
$stmt = $pdo->prepare("
    SELECT p.*, pr.name AS product_name 
    FROM payments p 
    JOIN products pr ON p.product_id = pr.product_id 
    WHERE payment_id = ?
");
$stmt->execute([$payment_id]);
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

// Simulate webhook call
$webhookUrl = "http://localhost/mock-paymongo/webhook.php"; // change if hosted elsewhere
$data = json_encode([
    "type" => "payment.paid",
    "data" => [
        "payment_id" => $payment['payment_id'],
        "product" => $payment['product_name'],
        "amount" => $payment['amount']
    ]
]);

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => $data,
    ],
];
$context = stream_context_create($options);
file_get_contents($webhookUrl, false, $context);

echo "<h1>Payment Successful!</h1>";
echo "<p>Product: {$payment['product_name']}</p>";
echo "<p>Amount: {$payment['amount']}</p>";
echo "<p>Status: Paid</p>";
?>
