<?php
class Client {
    private $id;
    private $nom;
    private $email;

    public function __construct($nom,$email){
        $this->nom=$nom;
        $this->email=$email;
    }

    public function __get($p){ return $this->$p; }
    public function setId($id){ $this->id=(int)$id; }
}
