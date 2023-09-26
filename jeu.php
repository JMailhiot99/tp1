<?php

class jeu extends CRUD
{

    /** Récuperation de tous les jeux de la table jeu
     * 
     * @return array
     */

    public function getJeux()
    {
        //Récuperation de l'objet PDO de connexion
        global $oPDO;
        //Execution de la requete SQL passé en paramètre
        $oPDOStmt = $oPDO->query("SELECT id,nom,annee_lancement,genre,prix FROM jeu ORDER BY id ASC");

        $jeux = $oPDOStmt->fetchAll(PDO::FETCH_ASSOC);
        return $jeux;
    }


    /**
     * @param int $id
     * @return array or boolean false (si aucun resultat)
     */
    public function getJeuById($id)
    {
        global $oPDO;
        $oPDOStmt = $oPDO->prepare("SELECT id,nom,annee_lancement,genre,prix FROM jeu where id = :id");
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

        //execution de la requete
        $oPDOStmt->execute();

        //recuperation de resultat
        $jeu = $oPDOStmt->fetchAll(PDO::FETCH_ASSOC);
        return $jeu;
    }


    public function ajouterJeu($jeu)
    {
        global $oPDO;
        try {
            //preparation de la requete
            $oPDOStmt = $oPDO->prepare('INSERT INTO jeu SET nom=:nom, annee_lancement=:annee_lancement, genre=:genre, prix=:prix');
            $oPDOStmt->bindParam(':nom', $jeu['nom'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':annee_lancement', $jeu['annee_lancement'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':genre', $jeu['genre'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':prix', $jeu['prix'], PDO::PARAM_INT);

            //execution de la requete
            $oPDOStmt->execute();
            return $oPDO->lastInsertId();
        } catch (PDOException $e) {
            // Gérer les erreurs PDO ici
            return false;
        }
    }




    //Method updateLivre
    public function UpdateJeuById($id, $data)
    {
        global $oPDO;

        try {
            $oPDOStmt = $oPDO->prepare('UPDATE jeu SET nom=:nom, annee_lancement=:annee_lancement, genre=:genre, prix=:prix WHERE id=:id');
            $oPDOStmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':annee_lancement', $data['annee_lancement'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':genre', $data['genre'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':prix', $data['prix'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

            $oPDOStmt->execute();

            // Vérifiez si la mise à jour a réussi
            if ($oPDOStmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {

            return false;
        }
    }



    //Method deleteLivre
    public function deleteJeu($id)
    {
        global $oPDO;

        $oPDOStmt = $oPDO->prepare("DELETE FROM jeu WHERE id=:id");
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

        $resultat = $oPDOStmt->execute();

        if ($resultat) {
            echo "Jeu supprimé correctement <br><br>";
        } else {
            echo "une erreur est survenue";
        }
    }
}