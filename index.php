<?php
include('./includes/db.php');
include('./includes/navbar.php');

$categoriesQuery = $db->query("SELECT * FROM categories");
$categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        #addProductForm {
            display: none;
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
    </style>
</head>
<body>

<div class="categories">
    <?php foreach ($categories as $category): ?>
        <div id="<?= htmlspecialchars($category['nom']) ?>" class="category">
            <h2><?= htmlspecialchars($category['nom']) ?></h2>
            
            <?php
            $productsQuery = $db->prepare("SELECT * FROM produits WHERE categorie_id = ?");
            $productsQuery->execute([$category['id']]);
            $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="products">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>">
                            <h3><?= htmlspecialchars($product['nom']) ?></h3>
                            <a href="product_details.php?id=<?= $product['id'] ?>">Voir les détails</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun produit dans cette catégorie.</p>
                <?php endif; ?>
            </div>
            <button class="see-all" onclick="window.location.href='list_category.php?id=<?= $category['id'] ?>'">Tout voir</button>
        </div>
    <?php endforeach; ?>
</div>




<button class="add-product-btn" onclick="toggleForm()">+</button>

<div id="addProductForm">
    <h2>Ajouter un Produit</h2>
    <form id="productForm" action="add_product.php" method="POST" enctype="multipart/form-data">

        <!-- Étape 1  -->
        <div class="step active">
            <label for="category">Catégorie :</label>
            <select id="category" name="category" required>
                <option value="" selected disabled>Choisir une option</option>
                <option value="1">Jeux de Société</option>
                <option value="2">Téléphonie</option>
                <option value="3">Vêtements</option>
                <option value="4">Musique</option>
            </select>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Entrez le nom du produit" required>
            <button type="button" onclick="nextStep()">Suivant</button>
        </div>

        <!-- Étape 2 -->
        <div class="step">
            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png, .gif" required>
            <button type="button" onclick="nextStep()">Suivant</button>
            <button type="button" onclick="prevStep()">Précédent</button>
        </div>

        <!-- Étape 3 -->
        <div class="step">
            <label for="description">Description :</label>
            <textarea id="description" name="description" placeholder="Ajoutez une description du produit."></textarea>
            <label for="details">Détails :</label>
            <textarea id="details" name="details" placeholder="Ajoutez des détails spécifiques."></textarea>
            <button type="submit">Ajouter</button>
            <button type="button" onclick="prevStep()">Précédent</button>
        </div>
    </form>
</div>

<script>
    function toggleForm() {
        var form = document.getElementById('addProductForm');
        form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
    }

    var currentStep = 0;
    var steps = document.querySelectorAll('.step');

    function showStep(stepIndex) {
        steps.forEach(function(step, index) {
            step.classList.remove('active');
            if (index === stepIndex) {
                step.classList.add('active');
            }
        });
    }

    function nextStep() {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }
</script>

</body>
</html>
</script>
</body>
</html>
