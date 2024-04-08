<?php

use PDO;
use Exception;

require_once ('../traitement/db.php');

class Billet
{
    private $conn;

    public function __construct($connexion)
    {
        $this->conn = $connexion;
    }


    public function ajouterBillet(
        $destination,
        $prix,
        $categorie
    ) {
        try {
            // Début de la transaction
            // Ajouter le billet
            $query = "INSERT INTO Billet (destination, prix, categorie) VALUES (:destination, :prix, :categorie)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':destination', $destination);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->execute();

            // Valider la transaction

            return $stmt->rowCount(); // Retourne le nombre de lignes affectées
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction et afficher un message d'erreur
            throw new Exception("Erreur : " . $e->getMessage());
        }
    }
    public function afficherBillet()
    {
        try {
            $query = "SELECT * FROM Billet";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur : " . $e->getMessage());
        }
    }
    

    public function modifierBillet($id, $destination, $prix, $categorie)
    {
        try {


            // Effectuer la mise à jour dans la base de données
            $query = "UPDATE Billet SET destination = :destination, prix = :prix, categorie = :categorie WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':destination', $destination, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
            $stmt->execute();



            return true; // Modification réussie
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la modification du billet : " . $e->getMessage());
        }
    }

    public function recupererBillet($id)
    {
        try {
            $query = "SELECT * FROM Billet WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du billet : " . $e->getMessage());
        }
    }
}

?>