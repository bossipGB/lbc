<?php
include('./includes/db.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $stmt = $db->prepare("SELECT * FROM produits WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="product-details">
    <img src="uploads/<?= htmlspecialchars($product['photo']) ?>" alt="Produit">
    <h3><?= htmlspecialchars($product['nom']) ?></h3>
    <p><?= htmlspecialchars($product['description']) ?></p>
    <p><strong>Détails:</strong> <?= htmlspecialchars($product['details']) ?></p>
</div>

</body>
</html>
