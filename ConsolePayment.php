<?php

require_once "./exception/AppExceptions.php";

require_once "./entity/Client.php";
require_once "./entity/Commande.php";
require_once "./entity/Paiement.php";
require_once "./entity/Virement.php";
require_once "./entity/CarteBancaire.php";
require_once "./entity/PayPal.php";

require_once "./repository/ClientRepository.php";
require_once "./repository/CommandeRepository.php";
require_once "./repository/PaiementRepository.php";

class ConsolePaymentApp
{
    private ClientRepository $clientRepository;
    private CommandeRepository $commandeRepository;
    private PaymentRepository $paymentRepository;

    public function __construct()
    {
        $this->clientRepository   = new ClientRepository();
        $this->commandeRepository = new CommandeRepository();
        $this->paymentRepository  = new PaymentRepository();
    }

    public function run()
    {
        echo "╔═════════════════════════════════════════════════════════╗\n";
        echo "║     SYSTÈME DE GESTION DE PAIEMENT - CONSOLE APP        ║\n";
        echo "╚═════════════════════════════════════════════════════════╝\n";

        while (true) {
            echo "┌─────────────────────────────────────────────────────────┐\n";
            echo "│ MENU PRINCIPAL                                          │\n";
            echo "├─────────────────────────────────────────────────────────┤\n";
            echo "│ 1. Créer un client                                      │\n";
            echo "│ 2. Lister les clients                                   │\n";
            echo "│ 3. Créer une commande                                   │\n";
            echo "│ 4. Lister les commandes                                 │\n";
            echo "│ 5. Créer un paiement                                    │\n";
            echo "│ 0. Quitter                                              │\n";
            echo "└─────────────────────────────────────────────────────────┘\n";
            $choix = trim(readline("Choix: "));

            try {
                match ($choix) {
                    "1" => $this->createClient(),
                    "2" => $this->listClients(),
                    "3" => $this->createCommande(),
                    "4" => $this->listCommandes(),
                    "5" => $this->createPayment(),
                    "0" => exit,
                    default => print "Choix invalide\n"
                };
            } catch (Exception $e) {
                echo "Erreur: " . $e->getMessage() . "\n";
            }
        }
    }

    private function createClient()
    {
        $name  = readline("Nom: ");
        $email = readline("Email: ");
        $this->clientRepository->create(new Client($name, $email));
    }

    private function listClients()
    {
        foreach ($this->clientRepository->findAll() as $c) {
            echo "{$c->id} {$c->nom} {$c->email}\n";
        }
    }

    private function createCommande()
    {
        $this->listClients();
        $idClient = readline("ID Client: ");
        $client = $this->clientRepository->findById($idClient);

        $montant = readline("Montant: ");
        $cmd = new Commande($montant);
        $cmd->setClient($client);

        $this->commandeRepository->create($cmd);
    }

    private function listCommandes()
    {
        foreach ($this->commandeRepository->findAll() as $c) {
            echo "{$c->id} {$c->client->nom} {$c->montant_total} {$c->statut}\n";
        }
    }

    private function createPayment()
    {
        $this->listCommandes();
        $id = readline("Veuillez choisir l'id de la commande: ");

        $commande = $this->commandeRepository->findById($id);

        if ($commande->statut === Commande::STATUS_PAYE) {
            throw new ValidationException("Cette commande est déjà payée");
        }
        echo "\n\n";
        echo "┌────────────────────────────┐\n";
        echo "│ Payment  MENU              │\n";
        echo "├────────────────────────────┤\n";
        echo "│ 1. Virement                │\n";
        echo "│ 2. Carte                   │\n";
        echo "│ 3. PayPal                  │\n";
        echo "└────────────────────────────┘\n";
        $type = readline("Type: ");

        $payment = match ($type) {
            "1" => new Virement($commande->montant_total, readline("RIB: ")),
            "2" => new Carte($commande->montant_total, readline("Carte: ")),
            "3" => new PayPal($commande->montant_total, readline("Email: "), readline("Password: ")),
            default => throw new ValidationException("Type invalide")
        };
        $payment->setCommande($commande);
        $payment->pay();

        $this->paymentRepository->create($payment);
        $this->commandeRepository->update($commande);
    }
}
