<?php
require_once "./Database/DatabaseConnection.php";

class PaymentRepository implements BaseRepository {

    private $db;

    public function __construct(){
        $this->db = (new DatabaseConnection())->getConnection();
    }

    public function findAll(){}
    public function findById($id){}

    public function create($p){
        $s=$this->db->prepare(
            "INSERT INTO paiements(montant,statut,commande_id) VALUES(?,?,?)"
        );
        $s->execute([$p->montant,$p->statut,$p->commande->id]);
    }

    public function update($o){}
    public function delete($id){}
}
