<!DOCTYPE html>
<html lang="en">
<?php


require_once ('ReservationClass.php');


require_once ('../partials/head.php');

require_once ('../partials/navbar.php'); ?>

<div class=" top">

    <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
            Ajouter une réservation
        </button>
        <?php
        // require_once('modifier.php');
        require_once ('ajouter.php');
        ?>
        <!-- Modal -->

    </div>


</div>

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php

        $result = new Reservation(connect());

        // var_dump($result);
        $reservations = $result->afficherReservations();
        foreach ($reservations as $reservation): ?>
            <div class="col">
                <div class="card bg-second card2" style="/* From https://css.glass */
background: rgba(255, 255, 255, 0.2);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 2, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);">
                    <div class="card-body">
                        <h5 class="card-title">Client:
                            <span>
                                <?= $reservation['nom'] . ' ' . $reservation['prenom']; ?>
                            </span>
                            <br>
                            <strong>Information:</strong>
                            <span>
                                <h6 class="card-subtitle mb-2 text-blue">

                                    <?= $reservation['telephone']; ?><br>
                                    <?= $reservation['adresse']; ?><br>
                                    <?= $reservation['date_reservation']; ?>

                                </h6>
                            </span>
                        </h5>
                        <strong>Destination </strong><br>
                        <h6 class="card-subtitle mb-2 ">
                            <?= $reservation['destination']; ?>
                        </h6>
                        <h6 class="card-subtitle mb-2 text-blue">
                            <?= $reservation['prix']; ?> F CFA ---
                            <?= $reservation['categorie']; ?>
                        </h6>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text">
                            <strong>Horaires </strong><br>
                            <?= $reservation['date_depart'] ?> --
                            <?= $reservation['heur_depart']; ?>
                            <br>
                            <?= $reservation['statut']; ?>
                            <br>
                        </p>
                    </div>
                    <a href="modifier.php?id=<?= $reservation['idR']; ?>" class="btn btn-primary">Modifier</a>
                    <a href="delete.php?id=<?= $reservation['idR']; ?>" <a href="delete.php?id=<?= $reservation['idR']; ?>"
                        class="btn text-red  hover:blue "
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>