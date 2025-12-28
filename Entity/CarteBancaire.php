<?php
class Carte extends Payment {
    private $creditCardNumber;

    public function __construct($m,$n){
        parent::__construct($m);
        $this->creditCardNumber=$n;
    }

    public function __get($p){ return $this->$p; }

    public function pay(){
        $this->statut=self::PAID;
        $this->commande->setStatus(Commande::STATUS_PAYE);
    }
}
