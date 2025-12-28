<?php

class CommandeRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Commande $commande)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO commandes (client_id, montant_total, statut)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([
            $commande->getClientId(),
            $commande->getMontantTotal(),
            $commande->getStatut()
        ]);
    }

    public function findByClientId(int $clientId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM commandes WHERE client_id = ?"
        );
        $stmt->execute([$clientId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findEnAttente(): array
    {
        return $this->pdo
            ->query("SELECT * FROM commandes WHERE statut = 'EN_ATTENTE_PAIEMENT'")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatut(int $commandeId, string $statut)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE commandes SET statut = ? WHERE id = ?"
        );
        $stmt->execute([$statut, $commandeId]);
    }
}
