<?php
require_once '../class/Database.php';

class Employes {
    private $id;
    private $prenom;
    private $id_secteur;

    /**
     * @param $id
     * @param $prenom
     */
    public function __construct($id, $prenom, $id_secteur)
    {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->id_secteur = $id_secteur;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    /**
     * @return mixed
     */
    public function getIdSecteur()
    {
        return $this->id_secteur;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function toArray()
    {
        return [
            'ID_SERVEUR' => $this->getId(),
            'NOM_COMPLET' => $this->getPrenom(),
            'ID_SECTEUR' => $this->getIdSecteur()
        ];
    }

    public static function getAllEmployes() {
        $db = new Database();
        $query = "SELECT 
    serveur.ID_SERVEUR, 
    serveur.NOM_COMPLET, 
    GROUP_CONCAT(relier.ID_SECTEUR) AS SECTEURS
FROM serveur
JOIN relier ON relier.ID_SERVEUR = serveur.ID_SERVEUR
WHERE serveur.EMPLOYE_ACTIF = 1
GROUP BY serveur.ID_SERVEUR, serveur.NOM_COMPLET
";
        $conn = $db->getConnection();
        $stmt = $db->requete($query);

        $employes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $secteurs = explode(',', $row['SECTEURS']);
            $employes[] = new Employes($row['ID_SERVEUR'], $row['NOM_COMPLET'], $secteurs);
        }

        return $employes;
    }

    public static function deleteEmployeById($id)
    {
        $db = new Database();
        $query = "UPDATE serveur SET EMPLOYE_ACTIF = 0 WHERE ID_SERVEUR = '$id'";
        $conn = $db->getConnection();
        return $db->requete($query);
    }

    public static function getEmployeById($id)
    {
        $db = new Database();
        $query = "SELECT 
    serveur.ID_SERVEUR, 
    serveur.NOM_COMPLET, 
    GROUP_CONCAT(relier.ID_SECTEUR) AS SECTEURS
FROM serveur
JOIN relier ON relier.ID_SERVEUR = serveur.ID_SERVEUR
WHERE serveur.id_serveur = '$id';";
        $conn = $db->getConnection();
        $stmt = $db->requete($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $secteurs = explode(',', $row['SECTEURS']);
        return new Employes($row['ID_SERVEUR'], $row['NOM_COMPLET'], $secteurs);
    }

//    private static function updateEmploye($id, $nom, $id_secteur)
//    {
//        $db = new Database();
//        $conn = $db->getConnection();
//        $query = "UPDATE serveur"
//    }

}