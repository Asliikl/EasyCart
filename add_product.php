<?php
include 'db.php';

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare('INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $price, $description, $image]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ürün Ekle</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Ürün Ekle</h1>
    <form action="add_product.php" method="post">
        <label for="name">Ürün Adı:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="price">Fiyat:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        <br>
        <label for="description">Açıklama:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="image">Resim URL:</label>
        <input type="text" id="image" name="image">
        <br>
        <button type="submit" name="add_product">Ürünü Ekle</button>
    </form>
    <a href="index.php">Ürünlere Geri Dön</a>
</body>
</html>
