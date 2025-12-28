<?php

class PaiementRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(int $commandeId, string $type, float $montant)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO paiements (commande_id, type_paiement, montant, statut, date_paiement)
             VALUES (?, ?, ?, 'PAYE', NOW())"
        );
        $stmt->execute([$commandeId, $type, $montant]);
    }
}
