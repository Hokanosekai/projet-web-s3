<?php

namespace App\Models;

use \App\Entities\Evenement;
use \App\Utils\BDD;
use \App\Utils\Utils;
use \PDO;

class EvenementModel extends BDD {

    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    /**
     * Methode pour compter les Evenements en fonction d'un type (all | theatre | concert | humour | exposition)
     *
     * @param int $type
     * @return mixed
     */
    public function count($type = 0) {
        $sql = $type === 0?
            "select count(id_evt) as count from evenements" :
            "select count(id_evt) as count from evenements where type = {$type}";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    /**
     * Methode pour récupérer les Evenements en fonction d'un type (all | theatre | concert | humour | exposition)
     *
     * @param int $limit
     * @param int $offset
     * @param int $type
     * @return array
     */
    public function findAll($limit = 1000, $offset = 0, $type = 0) {
        $sql = $type === 0?
            "select * from evenements evts
                    join evt_types evt_t 
                        on evts.type = evt_t.id_type
                    limit {$limit} offset {$offset};" :
            "select * from evenements evts
                    join evt_types evt_t 
                        on evts.type = evt_t.id_type
                    where evts.type = :typ
                    limit {$limit} offset {$offset};";

        $req = $this->pdo->prepare($sql);
        if ($type != 0)
            $req->bindParam(':typ', $type);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $evt = new Evenement();
            $evt->setId($row['id_evt']);
            $evt->setTitre($row['titre']);
            $evt->setDescription($row['description']);
            $evt->setImgPath($row['img_path']);
            $evt->setDateStart(Utils::parseDate($row['date_start']));
            $evt->setDateEnd(Utils::parseDate($row['date_end']));
            $evt->setTypeID($row['id_type']);
            $evt->setTypeName($row['name']);
            $evt->setPlaces($row['places']);
            $evt->setLieu($row['lieu']);

            $evts[] = $evt;
        }

        return $evts;
    }

    /**
     * Methode pour récupérer un EvenementModel en fonction d'un id
     *
     * @param $id
     * @return Evenement
     */
    public function findOne($id) {

        $sql = "select * from evenements evts
                    join evt_types evt_t 
                        on evts.type = evt_t.id_type
                    where id_evt = :id";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);
        $evt = new Evenement();

        $evt->setId($row['id_evt']);
        $evt->setTitre($row['titre']);
        $evt->setDescription($row['description']);
        $evt->setImgPath($row['img_path']);
        $evt->setDateStart(Utils::parseDate($row['date_start']));
        $evt->setDateEnd(Utils::parseDate($row['date_end']));
        $evt->setTypeID($row['id_type']);
        $evt->setTypeName($row['name']);
        $evt->setPlaces($row['places']);
        $evt->setLieu($row['lieu']);

        return $evt;
    }

    /**
     * Methode pour supprimer un EvenementModel
     *
     * @param $id
     * @return bool
     */
    public function deleteOne($id) {
        $sql = "delete from evenements evts where id_evt = :id;";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();

        return $req->rowCount() == 1;
    }

    /**
     * Methode pour mettre à jour un EvenementModel
     *
     * @param $evt
     * @return bool
     */
    public function updateOne($evt) {
        $sql = "update evenements set titre = :titre, description = :des, img_path = :pat, type = :typ, date_start = :start, date_end = :end, places = :places, lieu = :lieu where id_evt = :id;";

        $start = Utils::unparseDate($evt->getDateStart());
        $end = Utils::unparseDate($evt->getDateEnd());

        $req = $this->pdo->prepare($sql);
        $req->bindValue(':titre', $evt->getTitre());
        $req->bindValue(':des', $evt->getDescription());
        $req->bindValue(':pat', $evt->getImgPath());
        $req->bindValue(':typ', $evt->getType());
        $req->bindValue(':start', $start);
        $req->bindValue(':end', $end);
        $req->bindValue(':places', $evt->getPlaces());
        $req->bindValue(':lieu', $evt->getLieu());
        $req->bindValue(':id', $evt->getId());

        $req->execute();

        return $req->rowCount() == 1;
    }

    /**
     * Methode pour créer un EvenementModel
     *
     * @param $evt
     * @return string|null
     */
    public function createOne($evt) {
        $sql = "insert into evenements (titre, description, img_path, date_start, date_end, type, places, lieu) values (:titre, :desc, :path, :start, :end, :type, :places, :lieu)";

        $start = Utils::unparseDate($evt->getDateStart());
        $end = Utils::unparseDate($evt->getDateEnd());

        $req = $this->pdo->prepare($sql);
        $req->bindValue(':titre', $evt->getTitre());
        $req->bindValue(':desc', $evt->getDescription());
        $req->bindValue(':start', $start);
        $req->bindValue(':end', $end);
        $req->bindValue(':lieu', $evt->getLieu());
        $req->bindValue(':places', $evt->getPlaces());
        $req->bindValue(':path', $evt->getImgPath());
        $req->bindValue(':type', (int)$evt->getType());

        $req->execute();

        return $req->rowCount() == 1? $this->pdo->lastInsertId() : null;
    }

}
