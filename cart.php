<?php
include 'db.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $products = $pdo->prepare('SELECT * FROM cart WHERE product_id = ?');
    $products->execute([$product_id]);
    $cart_item = $products->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        $new_quantity = $cart_item['quantity'] + $quantity;
        $products = $pdo->prepare('UPDATE cart SET quantity = ? WHERE product_id = ?');
        $products->execute([$new_quantity, $product_id]);
    } else {
        $products = $pdo->prepare('INSERT INTO cart (product_id, quantity) VALUES (?, ?)');
        $products->execute([$product_id, $quantity]);
    }

    header('Location: cart.php');
    exit;
}

if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];

    $products = $pdo->prepare('DELETE FROM cart WHERE product_id = ?');
    $products->execute([$product_id]);

    header('Location: cart.php');
    exit;
}

$products = $pdo->query('SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id');
$cart_items = $products->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sepet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Sepet</h1>
    <ul>
        <?php foreach ($cart_items as $item): ?>
            <li>
                <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                <p><?php echo htmlspecialchars($item['quantity']); ?> adet</p>
                <p><?php echo htmlspecialchars($item['price']); ?> TL</p>
                <form action="cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                    <button type="submit" name="remove_from_cart">Sepetten Çıkar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Ürünlere Geri Dön</a>
</body>
</html>
