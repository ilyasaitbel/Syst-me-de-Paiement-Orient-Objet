<?php

abstract class Paiement implements PaiementInterface
{
    protected int $commandeId;
    protected float $montant;

    public function __construct(int $commandeId, float $montant)
    {
        $this->commandeId = $commandeId;
        $this->montant    = $montant;
    }
}
