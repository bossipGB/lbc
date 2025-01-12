<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label for="category">Catégorie</label>
            <select id="category" name="category" onchange="updateForm(this.value)">
                
                <option value="1">Jeux de Société</option>
                <option value="2">Téléphonie</option>
                <option value="3">Vêtements</option>
                <option value="4">Musique</option>
            </select>

            <label for="nom">Nom du produit</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">
            
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
            
            <div id="specificFields"></div>
            
            <button type="submit">Ajouter</button>
        </form>
    </div>
</div>