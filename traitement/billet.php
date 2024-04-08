<?php
require_once ('db.php');
require_once ('../billets/BilletClass.php');

if (isset($_POST['ajouter_billet'])) {
    $destination = $_POST['destination'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];

    // Créer une instance de la classe BilletManager avec la connexion à la base de données
    $billetManager = new Billet(connect());

    try {
        // Appeler la méthode ajouterBillet pour ajouter le billet
        $result = $billetManager->ajouterBillet($destination, $prix, $categorie);

        if ($result > 0) {
            // echo "Billet ajouté avec succès.";
            // Redirection vers une autre page si nécessaire
            header('Location: ../billets/index.php#Billet ajouté avec succès');
        } else {
            echo "Aucun billet ajouté.";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
// Gestion de la modification du billet
if (isset($_POST['modifier_billet'])) {
    $billet_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $destination = strip_tags($_POST['destination']);
    $prix = strip_tags($_POST['prix']);
    $categorie = strip_tags($_POST['categorie']);

    // Validation: Vérifiez si les champs obligatoires ne sont pas vides
    if (empty($destination) || empty($prix) || empty($categorie)) {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Créer une instance de la classe BilletManager avec la connexion à la base de données
    $billetManager = new Billet(connect());

    try {
        // Appeler la méthode modifierBillet pour mettre à jour le billet
        $billetManager->modifierBillet($billet_id, $destination, $prix, $categorie);
        echo "Billet modifié avec succès.";
        header('Location: ../billets/index.php');
        exit();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


