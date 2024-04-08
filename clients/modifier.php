<?php
// require_once ('../traitement/db.php');
require_once ('ReservationClass.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Créer une instance de la classe ReservationManager avec la connexion à la base de données

$id = isset($_GET['id']);
$result = new Reservation(connect());
$reservation = $result->recupererReservation($id);
if (!$reservation) {
    echo "Reservation non trouvézz.";
    exit();
}

// $conn = connect();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Réservation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Modifier Réservation</h2>
        <form method="post" action="modifier.php">
            <input type="hidden" name="reservation_id" value="<?= $reservation['id']; ?>">
            <!-- Ajoutez ici les autres champs du formulaire -->
            <div class="mb-3">
                <label for="date_depart">Date de Départ</label>
                <input type="date" class="form-control" id="date_depart" name="date_depart"
                    value="<?= $reservation['date_depart']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_depart">Nom</label>
                <input type="texte" class="form-control" id="date_depart" name="nom"
                    value="<?= $reservation['nom_client']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_depart">Prenom </label>
                <input type="texte" class="form-control" id="date_depart" name="prenom"
                    value="<?= $reservation['prenom_client']; ?>" required>
            </div>
            <div class="mb-3">
                <select name="statut" id="">
                    <option value="En cours" <?= ($reservation['statut'] == 'En cours') ? 'selected' : ''; ?>>
                        Disponible
                    </option>
                    <option value="Passe" <?= ($reservation['statut'] == 'Passe') ? 'selected' : ''; ?>>
                        Indisponible
                    </option>
                </select>
            </div>
            <button type="submit" name="modifier_reservation" class="btn btn-primary">Modifier la réservation</button>
        </form>
    </div>

</body>

</html>