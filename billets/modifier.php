<?php
require_once ('../billets/BilletClass.php');



$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$result = new Billet(connect());

// var_dump($result);
$billet = $result->recupererBillet($id);
if (!$billet) {
    echo "Billet non trouvé.";
    exit();
}
?>
<?php require_once ("../partials/head.php");
require_once ("../partials/navbar.php");
// Connexion à la base de données
?>



<div class="container mt-5">
    <h2>Modifier Réservation</h2>
    <form method="post" action="../traitement/billet.php">
        <input type="hidden" name="id" value="<?= $billet['id']; ?>">
        <!-- Ajoutez ici les autres champs du formulaire -->
        <div class="mb-3">
            <label for="destination">Date de Départ</label>
            <input type="texte" class="form-control" id="destination" name="destination"
                value="<?= $billet['destination']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_depart">Prix</label>
            <input type="texte" class="form-control" id="date_depart" name="prix" value="<?= $billet['prix']; ?>"
                required>
        </div>

        <div class="mb-3">
            <select name="categorie" id="">
                <option value="Simple" <?= ($billet['categorie'] == 'Simple') ? 'selected' : ''; ?>>
                    Simple
                </option>
                <option value="Vip" <?= ($billet['categorie'] == 'Vip') ? 'selected' : ''; ?>>
                    Vip
                </option>
            </select>
        </div>
        <button type="submit" name="modifier_billet" class="btn btn-primary">Modifier la réservation</button>
    </form>
</div>
<!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>