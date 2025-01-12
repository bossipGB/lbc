<?php
include('./includes/db.php'); 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    $stmt = $db->prepare("SELECT * FROM produits WHERE categorie_id = ?");
    $stmt->execute([$category_id]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categoryStmt = $db->prepare("SELECT nom FROM categories WHERE id = ?");
    $categoryStmt->execute([$category_id]);
    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Catégorie non trouvée.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - <?= htmlspecialchars($category['nom']) ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include('./includes/navbar.php'); ?>

<div class="container">
    <h1 class="my-4">Produits de la catégorie : <?= htmlspecialchars($category['nom']) ?></h1>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($product['photo']) ?>" class="card-img-top" alt="Produit">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['nom']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                        <a href="product_details.php?id=<?= $product['id'] ?>" class="btn btn-primary">Voir les détails</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
