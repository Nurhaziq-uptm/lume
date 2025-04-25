<?php
include 'config.php';
require_admin();

if (isset($_POST['product_id'])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_POST['product_id']]);
}

header("Location: admin.php");
exit();
?>