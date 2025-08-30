<?php
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Log webhook events
file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - " . json_encode($data) . "\n", FILE_APPEND);

http_response_code(200);
echo json_encode(["status" => "received"]);
?>
