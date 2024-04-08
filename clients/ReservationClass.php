<?php

use PDO;
use Exception;

require_once ('../traitement/db.php');

class Reservation
{
    private $conn;

    public function __construct($connexion)
    {
        $this->conn = $connexion;
    }

    public function ajouterReservation($nom, $prenom, $adresse, $telephone, $date_depart, $heur_depart, $id_billet)
    {
        try {
            // Début de la transaction

            // Ajouter le client
            $query_client = "INSERT INTO Client (nom, prenom, adresse, telephone) VALUES (:nom, :prenom, :adresse, :telephone)";
            $stmt_client = $this->conn->prepare($query_client);
            $stmt_client->bindParam(':nom', $nom);
            $stmt_client->bindParam(':prenom', $prenom);
            $stmt_client->bindParam(':adresse', $adresse);
            $stmt_client->bindParam(':telephone', $telephone);
            $stmt_client->execute();

            // Récupérer l'ID du dernier client ajouté
            $id_client = $this->conn->lastInsertId();

            // Ajouter la réservation avec l'ID du client et du billet
            $query_reservation = "INSERT INTO Reservation (date_reservation, date_depart, heur_depart, statut, id_client, id_billet)
VALUES (NOW(), :date_depart, :heur_depart, 'En cours', :id_client, :id_billet)";
            $stmt_reservation = $this->conn->prepare($query_reservation);
            $stmt_reservation->bindParam(':id_client', $id_client);
            $stmt_reservation->bindParam(':id_billet', $id_billet);
            $stmt_reservation->bindParam(':date_depart', $date_depart);
            $stmt_reservation->bindParam(':heur_depart', $heur_depart);
            $stmt_reservation->execute();

            // Valider la transaction

            echo "Réservation ajoutée avec succès.";
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction et afficher un message d'erreur
            throw new Exception("Erreur : " . $e->getMessage());
        }
    }
    public function afficherReservations()
    {
        try {
            $query = "SELECT * , Reservation.id AS idR , Client.id AS idC FROM Reservation  
            INNER JOIN Client ON Reservation.id_client = Client.id
            INNER JOIN Billet ON Reservation.id_billet = Billet.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw new Exception("Erreur : " . $e->getMessage());
        }
    }

    public function recupererReservation($id)
    {
        try {
            $query = "SELECT * FROM Reservation Join Client on Reservation.id_client = Client. id  WHERE Reservation.id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw new Exception("Erreur : " . $e->getMessage());
        }
    }
    // public function recupererReservation($id)
    // {

    //     try {
    //         // Récupérer les détails de la réservation
    //         $query = "SELECT Reservation.*, Client.nom AS nom_client, Client.prenom AS prenom_client
    //         FROM Reservation
    //         JOIN Client ON Reservation.id_client = Client.id
    //         WHERE Reservation.id = :id";
    //         $stmt = $this->conn->prepare($query);
    //         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //         $stmt->execute();
    //         return $stmt->fetch(PDO::FETCH_ASSOC);


    //     } catch (Exception $e) {
    //         echo "Erreur : " . $e->getMessage();
    //     }
    // }
}