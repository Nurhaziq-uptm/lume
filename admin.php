<?php
include 'config.php';
require_admin();

// Handle product operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add product
    if (isset($_POST['add_product'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $stmt = $pdo->prepare("INSERT INTO products (name, price, stock, image, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['price'],
            $_POST['stock'],
            $target_file,
            $_POST['description']
        ]);
    }
    
    // Update stock
    if (isset($_POST['update_stock'])) {
        $stmt = $pdo->prepare("UPDATE products SET stock = ? WHERE id = ?");
        $stmt->execute([$_POST['stock'], $_POST['product_id']]);
    }
}

$products = $pdo->query("SELECT * FROM products")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-panel { max-width: 1200px; margin: 2rem auto; padding: 2rem; }
        .product-form { background: white; padding: 2rem; border-radius: 8px; }
        .product-list { margin-top: 2rem; }
        .product-item { display: flex; gap: 1rem; align-items: center; padding: 1rem; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="main.php">← Store Front</a>
        <a href="logout.php">Logout</a>
    </nav>

    <main class="admin-panel">
        <div class="product-form">
            <h1>Add New Product</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" step="0.01" name="price" placeholder="Price" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <textarea name="description" placeholder="Description"></textarea>
                <input type="file" name="image" accept="image/*" required>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>

        <div class="product-list">
            <h2>Current Products</h2>
            <?php foreach ($products as $product): ?>
            <div class="product-item">
                <img src="<?= $product['image'] ?>" width="100">
                <div>
                    <h3><?= $product['name'] ?></h3>
                    <p>RM<?= number_format($product['price'], 2) ?> | Stock: <?= $product['stock'] ?></p>
                    <form method="POST">
                        <input type="number" name="stock" value="<?= $product['stock'] ?>">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit" name="update_stock">Update Stock</button>
                    </form>
                </div>
                <form method="POST" action="delete_product.php">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>