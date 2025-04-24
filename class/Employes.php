<?php
require_once '../class/Database.php';

class Employes {
    private $id;
    private $prenom;

    /**
     * @param $id
     * @param $prenom
     */
    public function __construct($id, $prenom)
    {
        $this->id = $id;
        $this->prenom = $prenom;
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
        ];
    }

    public static function getAllEmployes() {
        $db = new Database();
        $query = "SELECT ID_SERVEUR, NOM_COMPLET FROM serveur WHERE EMPLOYE_ACTIF = 1";
        $conn = $db->getConnection();
        $stmt = $db->requete($query);

        $employes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $employes[] = new Employes($row['ID_SERVEUR'], $row['NOM_COMPLET']);
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
        $query = "SELECT * FROM serveur JOIN relier on relier.id_serveur = serveur.id_serveur WHERE serveur.id_serveur = '$id';";
        $conn = $db->getConnection();
        $stmt = $db->requete($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Employes($row['ID_SERVEUR'], $row['NOM_COMPLET']);
    }

}