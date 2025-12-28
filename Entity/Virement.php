<?php
class Virement extends Payment {
    private $rib;

    public function __construct($m,$r){
        parent::__construct($m);
        $this->rib=$r;
    }

    public function __get($p){ return $this->$p; }

    public function pay(){
        $this->statut=self::PAID;
        $this->commande->setStatus(Commande::STATUS_PAYE);
    }
}
