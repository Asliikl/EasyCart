<?php
include 'db.php';

$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ürün Listesi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="cart.php">Sepeti görüntüle</a>
    <h1>Ürünler</h1>
    <a href="add_product.php">Yeni Ürün Ekle</a>
    <ul>
        <?php foreach ($products as $product) : ?>
            <li>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><?php echo htmlspecialchars($product['price']); ?> TL</p>
                <form action="cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" name="add_to_cart">Sepete Ekle</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>


</body>

</html>