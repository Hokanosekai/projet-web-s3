<?php

/**
 * Class EvenementManager
 */
class EvenementManager extends BDD {

    private $pdo;
    private $type;

    /**
     * EvenementManager constructor.
     * @param $type
     */
    public function __construct($type = null) {
        $this->pdo = $this->connect();
        $this->type = $type;
    }


    /**
     * @param false $type
     * @return mixed
     */
    public function count($type = false) {
        $sql = !$type?
            "select count(id_evt) as count from evenements" :
            "select count(id_evt) as count from evenements where type = {$type}";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    /**
     * @param int $limit
     * @return array
     */
    public function findAll($limit = 1000) {
        $sql = "select * from evenements evts
                    join evt_types evt_t 
                        on evts.type = evt_t.id_type
                    where evts.type = :typ
                    limit {$limit}";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':typ', $this->type);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $evt = new EvenementObject();
            $evt->setId($row['id_evt']);
            $evt->setTitre($row['titre']);
            $evt->setDescription($row['description']);
            $evt->setImgPath(ASSETS.$row['img_path']);
            $evt->setDateStart($row['date_start']);
            $evt->setDateEnd($row['date_end']);
            $evt->setTypeID($row['id_type']);
            $evt->setTypeName($row['name']);
            $evt->setPlaces($row['places']);
            $evt->setLieu($row['lieu']);

            $evts[] = $evt;
        }

        return $evts;
    }

    /**
     * @param $id
     * @return EvenementObject
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
        $evt = new EvenementObject();

        $evt->setId($row['id_evt']);
        $evt->setTitre($row['titre']);
        $evt->setDescription($row['description']);
        $evt->setImgPath(ASSETS.$row['img_path']);
        $evt->setDateStart($row['date_start']);
        $evt->setDateEnd($row['date_end']);
        $evt->setTypeID($row['id_type']);
        $evt->setTypeName($row['name']);
        $evt->setPlaces($row['places']);
        $evt->setLieu($row['lieu']);

        return $evt;
    }

}
