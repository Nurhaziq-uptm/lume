<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);
    
    header("Location: contact.php?success=1");
    exit();
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lume - Contact</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Contact form styling */
    .contact-form {
      max-width: 600px;
      margin: 2rem auto;
      padding: 1rem;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .contact-form label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
    }

    .contact-form button {
      width: 100%;
      padding: 0.8rem;
      background-color: #ff4081;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .contact-form button:hover {
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
    <section class="contact-form">
      <h1>Contact Us</h1>
      <form action="contact.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
      </form>
    </section>
	  <section class="social-media">
  <h3>Follow Us On Our Socials!</h3>
  <div class="social-icons">
    <a href="https://facebook.com" target="_blank"><img src="uploads/fb.png" alt="Facebook" width="70"></a>
    <a href="https://twitter.com" target="_blank"><img src="uploads/x_logo.jpg" alt="Twitter" width="70"></a>
    <a href="https://instagram.com" target="_blank"><img src="uploads/ig.jpg" alt="Instagram" width="70"></a>
    <a href="https://youtube.com" target="_blank"><img src="uploads/yt.jpg" alt="YouTube" width="70"></a>
  </div>
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
