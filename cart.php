<?php
include 'config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Remove item logic
if (isset($_GET['remove'])) {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['remove'], $_SESSION['user_id']]);
}

// Get cart items
$stmt = $pdo->prepare("
    SELECT o.id AS order_id, p.* 
    FROM orders o
    JOIN products p ON o.product_id = p.id
    WHERE o.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll();

// Calculate total
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'];
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lume - Cart</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Cart page specific styles */
    .cart-container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
      border-bottom: 1px solid #ccc;
      padding-bottom: 1rem;
    }

    .cart-item img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      margin-right: 1rem;
    }

    .cart-item h4 {
      margin: 0;
      font-size: 1.1rem;
    }

    .cart-item p {
      margin: 0.5rem 0;
      color: #777;
    }

    .cart-item .price {
      font-weight: bold;
      color: #ff4081;
    }

    .cart-item .remove-btn {
      background-color: #ff4081;
      color: white;
      border: none;
      padding: 0.5rem;
      border-radius: 4px;
      cursor: pointer;
    }

    .cart-item .remove-btn:hover {
      background-color: #e73370;
    }

    .total {
      display: flex;
      justify-content: space-between;
      font-size: 1.2rem;
      margin-top: 1.5rem;
    }

    .checkout-btn {
      width: 100%;
      padding: 1rem;
      background-color: #ff4081;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .checkout-btn:hover {
      background-color: #e73370;
    }
  </style>
</head>
<body>
  <header>
	<nav class="navbar">
    	<img src="uploads/LUME(1).png" alt="Lume Logo" width="60" />
    	<a href="main.php">Home</a>
    	<a href="products.php">Products</a>
    	<a href="contact.php">Contact</a>
    	<a href="cart.php">Cart</a>
    	<?php if(isset($_SESSION['username'])): ?>
        	<a href="logout.php">Logout</a>
    	<?php else: ?>
        	<a href="login.php">Login</a>
    	<?php endif; ?>
	</nav>
  </header>

  <main>
    <section class="cart-container">
      <h1>Your Cart</h1>

            <?php foreach ($cart_items as $item): ?>
            <div class="cart-item">
                <img src="<?= $item['image'] ?>" 
                     alt="<?= $item['name'] ?>" 
                     width="100">
                <div>
                    <h4><?= $item['name'] ?></h4>
                    <p class="price">RM<?= number_format($item['price'], 2) ?></p>
                </div>
                <!-- UPDATED REMOVE LINK -->
                <a href="cart.php?remove=<?= $item['order_id'] ?>" 
                   class="remove-btn"
                   onclick="return confirm('Remove this item?')">
                    Remove
                </a>
            </div>
            <?php endforeach; ?>

            <!-- DYNAMIC TOTAL -->
            <div class="total">
                <span>Total:</span>
                <span class="price">RM<?= number_format($total, 2) ?></span>
            </div>

      <button class="checkout-btn">Proceed to Checkout</button>
    </section>
  </main>

  <footer>
<div class="contact-info">
  <h3>Contact Information</h3>
  <p>Email: support@lume.com</p>
  <p>Phone: +6012-3456789</p>
  <p>Business Hours: Mon - Fri, 10AM - 6PM</p>
</div>
    &copy; 2025 Lume. All rights reserved.
  </footer>
</body>
</html>
