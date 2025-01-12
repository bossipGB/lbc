<?php
include('./includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $details = $_POST['details'];

    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $photoPath = 'uploads/' . basename($photoName);

    move_uploaded_file($photoTmpName, $photoPath);

    $detailsJSON = json_encode($details);

    try {
        $stmt = $db->prepare("INSERT INTO produits (nom, categorie_id, photo, description, details) 
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $category, $photoPath, $description, $detailsJSON]);

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
