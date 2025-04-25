<?php 
include 'config.php';

?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lume</title>
  <link rel="stylesheet" href="style.css" />
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

<main class="home-hero">

  <section class="hero-banner">
    <h1>Welcome to Lume</h1>
    <p>Where music meets fashion. Discover unique merch from your favourite artists.</p>
    <a href="products.php" class="shop-btn">Shop Now</a>
	  <section class="featured-artists">
  <h2>Featured Artists</h2>
  <div class="artist-grid">
    <div class="artist">
      <img src="uploads/gd.webp" alt="G-Dragon" width="400">
      <h3>G-Dragon</h3>
		<p>G-Dragon is a South Korean rapper, singer-songwriter, and fashion icon, known for his work in BIGBANG and his solo career that redefined K-pop aesthetics.</p>
    </div>
    <div class="artist">
      <img src="uploads/taylor_swift.jpg" alt="Taylor Swift" width="400">
      <h3>Taylor Swift</h3>
		<p>Taylor Swift is an American singer-songwriter renowned for her storytelling, genre-switching albums, and massive global fanbase.</p>
    </div>
    <div class="artist">
      <img src="uploads/weeknd.jpg" alt="The Weeknd" width="400">
      <h3>The Weeknd</h3>
	 <p>The Weeknd is a Canadian singer known for his distinctive voice and hit tracks blending R&B, pop, and electronic vibes.</p>
    </div>
  </div>
<section class="about-us">
  <h2>About Lume</h2>
  <p>At Lume, we offer exclusive and high-quality merchandise for music fans worldwide. Whether you're looking for your favorite artist's latest collection or a unique item to showcase your passion for music, we've got you covered. Join the Lume family and express your love for music with pride!</p>
  <p>We’re dedicated to providing you with the best fan gear, from clothing to accessories, with fast shipping and exceptional customer service. Get ready to represent your favorite music artists in style!</p>
</section>

</section>
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
