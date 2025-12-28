<?php
class PayPal extends Payment {
    private $paymentEmail;
    private $paymentPassword;

    public function __construct($m,$e,$p){
        parent::__construct($m);
        $this->paymentEmail=$e;
        $this->paymentPassword=$p;
    }

    public function __get($p){ return $this->$p; }

    public function pay(){
        $this->statut=self::PAID;
        $this->commande->setStatus(Commande::STATUS_PAYE);
    }
}
