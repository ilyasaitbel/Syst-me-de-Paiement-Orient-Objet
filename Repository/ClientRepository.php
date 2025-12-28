<?php
require_once "./Database/DatabaseConnection.php";
require_once "BaseRepository.php";

class ClientRepository implements BaseRepository {

    private $db;

    public function __construct(){
        $this->db = (new DatabaseConnection())->getConnection();
    }

    public function findAll(){
        return $this->db->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id){
        $s=$this->db->prepare("SELECT * FROM clients WHERE id=?");
        $s->execute([$id]);
        return $s->fetch(PDO::FETCH_OBJ);
    }

    public function create($c){
        $s=$this->db->prepare("INSERT INTO clients(nom,email) VALUES(?,?)");
        $s->execute([$c->name,$c->email]);
    }

    public function update($o){}
    public function delete($id){}
}
