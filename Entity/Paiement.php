<?php
abstract class Payment
{
    protected $id;
    protected $montant;
    protected $statut;
    protected $commande;

    public const UNPAID = "EN_ATTENTE";
    public const PAID = "PAYE";


    public function __construct($m)
    {
        $this->montant = $m;
        $this->statut = self::UNPAID;
    }

    abstract public function pay();
    public function setCommande($c)
    {
        if (!$c instanceof Commande) {
            throw new ValidationException("Commande invalide (stdClass détecté)");
        }
        $this->commande = $c;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }
}
