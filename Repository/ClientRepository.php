<?php

class ClientRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createclient(Client $client)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients (nom, email) VALUES (?, ?)" );

        $stmt->execute([
            $client->getName(),
            $client->getEmail()
        ]);
         return $this->pdo->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC);
    }
}