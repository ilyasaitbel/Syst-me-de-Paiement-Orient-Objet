<?php

class Commande
{
    private int $clientId;
    private float $montantTotal;
    private string $statut;

    public function __construct(int $clientId, float $montantTotal, string $statut = 'EN_ATTENTE_PAIEMENT')
    {
        $this->clientId     = $clientId;
        $this->montantTotal = $montantTotal;
        $this->statut       = $statut;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getMontantTotal(): float
    {
        return $this->montantTotal;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut)
    {
        $this->statut = $statut;
    }
}
