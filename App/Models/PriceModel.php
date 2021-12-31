<?php

namespace App\Models;

use App\Entities\Price;
use \App\Utils\BDD;
use \PDO;

class PriceModel extends BDD {

    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    /**
     * Methode pour savoir si Prix existe en fonction d'un id
     *
     * @param $id
     * @return mixed
     */
    public function exists($id) {
        $sql = "select * from prices
                    where id_price = :id";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function findOne($id) {
        $sql = "select * from prices
                    where id_price = :id";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        $price = new Price();
        $price->setId($id);
        $price->setPrix($row['prix']);
        $price->setTitre($row['titre']);
        $price->setEvtId($row['evt_id']);

        return $price;
    }

    /**
     * Methode pour récupérer tous les Prix en fonction d'un EvenementModel
     *
     * @param $idEvt
     * @return array
     */
    public function findAll($idEvt) {
        $sql = "select * from prices
                    where evt_id = :id";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $idEvt);
        $req->execute();

        $prices = [];

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $price = new \App\Entities\Price();
            $price->setId($row['id_price']);
            $price->setTitre($row['titre']);
            $price->setPrix($row['prix']);

            $prices[] = $price;
        }
        return $prices;
    }

    /**
     * Methode pour mettre à jour un Prix
     *
     * @param $price
     * @return bool
     */
    public function updateOne($price) {
        $sql = "update prices set titre = :titre, prix = :prix where id_price = :id;";


        $req = $this->pdo->prepare($sql);
        $req->bindValue(':titre', $price->getTitre());
        $req->bindValue(':prix', $price->getPrix());
        $req->bindValue(':id', $price->getId());

        $req->execute();

        return $req->rowCount() == 1;
    }

    /**
     * Meethode pour créer un Prix
     *
     * @param $price
     * @return string|null
     */
    public function createOne($price) {
        $sql = "insert into prices (titre, prix, evt_id) values (:titre, :prix, :evt)";

        $req = $this->pdo->prepare($sql);
        $req->bindValue(':titre', $price->getTitre());
        $req->bindValue(':prix', $price->getPrix());
        $req->bindValue(':evt', $price->getEvtId());

        $req->execute();

        return $req->rowCount() == 1? $this->pdo->lastInsertId() : null;
    }

    /**
     * Methode pour supprimer un Prix
     *
     * @param $id
     * @return bool
     */
    public function deleteOne($id) {
        $sql = "delete from prices where id_price = :id";

        $req = $this->pdo->prepare($sql);
        $req->bindValue(':id', $id);

        $req->execute();

        return $req->rowCount() == 1;
    }
}