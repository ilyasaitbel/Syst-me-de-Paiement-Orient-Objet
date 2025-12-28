<?php
class client{
    private $nom;
    private $email;
    public function __construct($nom, $email)
    {
        $this->nom = $nom;
        $this->email = $email;
    }
     public function getName()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
}
