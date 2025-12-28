<?php

require_once 'Database/DatabaseConnection.php';
require_once 'Entity/Client.php';
require_once 'Entity/Commande.php';

require_once 'Repository/ClientRepository.php';
require_once 'Repository/CommandeRepository.php';
require_once 'Repository/PaiementRepository.php';

$db  = new DatabaseConnection();
$pdo = $db->getConnection();

$ClientRepository  = new ClientRepository($pdo);
$Commande = new CommandeRepository($pdo);
// $Paiement = new PaiementRepository($pdo);

while (true) {

    echo "\n==============================\n";
    echo " SYSTEME DE PAIEMENT - MENU\n";
    echo "==============================\n";
    echo "1. Créer un Client\n";
    echo "2. Créer une commande\n";
    echo "3. Payer une commande\n";
    echo "4. Afficher les commandes\n";
    echo "0. Quitter\n";
    echo "------------------------------\n";

    $choix = readline("Votre choix : ");

    switch ($choix) {
        case 1:
            $name   = readline("Nom : ");
            $email = readline("Email : ");
            $client=new Client($name,$email);
            $ClientRepository->createclient($client);
              echo "client created \n";
            break;

        case 2:

            $Commande->createCommande();
            break;

        case 3:
            $Paiement->payerCommande();
            break;

        case 4:
            $Commande->afficherCommandes();
            break;

        case 0:
            echo "Au revoir\n";
            exit;

        default:
            echo "Choix invalide\n";
    }
}
