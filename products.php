<?php
include 'config.php';
$products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Lume</title>
  <link rel="stylesheet" href="style.css">
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

  <main class="products">
 
      <?php foreach ($products as $product): ?>
      <div class="product">
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="230">
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        <p>RM<?= number_format($product['price'], 2) ?></p>
        <form method="POST" action="add_to_cart.php">
          <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
          <button type="submit" class="add-to-cart">Add to Cart</button>
        </form>
      </div>
      <?php endforeach; ?>
    
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
