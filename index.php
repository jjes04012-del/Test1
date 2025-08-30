<?php
include 'config.php';

// Fetch products from database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mock PayMongo Store</title>
</head>
<body>
    <h1>Mock Store</h1>
    <form action="checkout.php" method="POST">
        <label>Product:</label>
        <select name="product_id">
            <?php foreach($products as $p): ?>
                <option value="<?= $p['product_id'] ?>">
                    <?= $p['name'] ?> - <?= $p['price'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label>Amount:</label>
        <input type="number" name="amount" required>
        <br><br>
        <label>Secret Key:</label>
        <input type="text" name="secret_key" required>
        <br><br>
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
