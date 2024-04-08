<?php

require_once ("BilletClass.php");

// require_once ("../traitement/db.php");

// // Connexion à la base de données
// $conn = connect();
// $query = "SELECT * FROM Billet ";

// $stmt = $conn->prepare($query);
// $stmt->execute();
// $billets = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<body>
    <?php require_once ('../partials/head.php'); ?>

    <?php require_once ('../partials/navbar.php'); ?>

    <div class=" top">

        <div class="container mt-5">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
                Ajouter une Billet
            </button>

            <!-- Modal -->

        </div>
        <div class="container mt-5">
            <h2>Liste des Billets</h2>
            <table class="table">
                <thead>
                    <tr>

                        <th>Destination</th>
                        <th>Prix</th>
                        <th>Categorie</th>
                        <th>Action</th>
                    </tr>
                </thead>



                <tbody>
                    <?php

                    $result = new Billet(connect());

                    // var_dump($result);
                    $billets = $result->afficherBillet();

                    foreach ($billets as $billet): ?>
                        <tr>

                            <td>
                                <?= $billet['destination']; ?>
                            </td>
                            <td>
                                <?= $billet['prix']; ?>
                            </td>
                            <td>
                                <?= $billet['categorie']; ?>
                            </td>
                            <td>
                                <a href="modifier.php?id=<?= $billet['id']; ?>" class="btn btn-warning">Modifier</a>
                                <a href="delete.php?id=<?= $billet['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this billet?')">Delete</a>

                            </td>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="container mt-5">
            <!-- Bouton pour ouvrir le modal -->

            <!-- Modal -->
            <div class="modal bg fade" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une Billet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Formulaire pour ajouter un client, une réservation et un billet -->
                            <form method="post" action="../traitement/billet.php">
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input type="text" class="form-control" id="destination" name="destination"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="text" class="form-control" id="prix" name="prix" required>
                                </div>
                                <select name="categorie" id="">
                                    <option value="Simple" <?= ($reservation['categorie'] == 'Simple') ? 'selected' : ''; ?>>
                                        Simple
                                    </option>
                                    <option value="Vip" <?= ($reservation['categorie'] == 'Vip') ? 'selected' : ''; ?>>
                                        Vip
                                    </option>
                                </select>


                                <button type="submit" name="ajouter_billet" class="btn btn-primary">
                                    Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>