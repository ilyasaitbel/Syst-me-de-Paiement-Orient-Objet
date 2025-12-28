<?php
class Commande
{
    private $id;
    private $montant_total;
    private $statut;
    private $client;

    public const STATUS_EN_ATTENTE = "EN_ATTENTE_PAIEMENT";
    public const STATUS_PAYE = "PAYEE";

    public function __construct($m)
    {
        $this->montant_total = $m;
        $this->statut = self::STATUS_EN_ATTENTE;
    }

    public function __get($p)
    {
        return $this->$p;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function setClient($c)
    {
        $this->client = $c;
    }

    public function setStatus($s)
    {
        $this->statut = $s;
    }
}
