<?php
require_once "./Database/DatabaseConnection.php";

class CommandeRepository implements BaseRepository
{

    private $db;

    public function __construct()
    {
        $this->db = (new DatabaseConnection())->getConnection();
    }

    public function findAll()
    {
        $sql = " SELECT c.id AS cmd_id,c.montant_total,c.statut,cl.id AS client_id,cl.nom,cl.email 
        FROM commandes c
        JOIN clients cl ON cl.id = c.client_id
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

        $commandes = [];

        foreach ($rows as $r) {
            $client = new Client($r->nom, $r->email);
            $client->setId($r->client_id);

            $cmd = new Commande($r->montant_total);
            $cmd->setId($r->cmd_id);
            $cmd->setClient($client);
            $cmd->setStatus($r->statut);

            $commandes[] = $cmd;
        }

        return $commandes;
    }


    public function findById($id)
    {
        $sql = "
        SELECT 
            c.id AS cmd_id,
            c.montant_total,
            c.statut,
            cl.id AS client_id,
            cl.nom,
            cl.email
        FROM commandes c
        JOIN clients cl ON cl.id = c.client_id
        WHERE c.id = ?
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$r) {
            throw new EntitySearchException('Commande introuvable');
        }

        $client = new Client($r->nom, $r->email);
        $client->setId($r->client_id);

        $commande = new Commande($r->montant_total);
        $commande->setId($r->cmd_id);
        $commande->setClient($client);
        $commande->setStatus($r->statut);

        return $commande;
    }


    public function create($c)
    {
        $s = $this->db->prepare(
            "INSERT INTO commandes(montant_total,statut,client_id) VALUES(?,?,?)"
        );
        $s->execute([$c->montantTotal, $c->statut, $c->client->id]);
    }

    public function update($c)
    {
        $s = $this->db->prepare("UPDATE commandes SET statut=? WHERE id=?");
        $s->execute([$c->statut, $c->id]);
    }

    public function delete($id) {}
}
