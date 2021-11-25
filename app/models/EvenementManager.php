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

    public function findAllEvts($limit = 1000, $offset = 0) {
        $sql = "select * from evenements evts
                    join evt_types evt_t 
                        on evts.type = evt_t.id_type
                    limit {$limit} offset {$offset};";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $evt = new EvenementObject();
            $evt->setId($row['id_evt']);
            $evt->setTitre($row['titre']);
            $evt->setDescription($row['description']);
            $evt->setImgPath(ASSETS.$row['img_path']);
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
     * @param int $limit
     * @return array
     */
    public function findAll($limit = 1000, $offset = 0) {
        $sql = "select * from evenements evts
                    join evt_types evt_t 
                        on evts.type = evt_t.id_type
                    where evts.type = :typ
                    limit {$limit} offset {$offset};";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':typ', $this->type);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $evt = new EvenementObject();
            $evt->setId($row['id_evt']);
            $evt->setTitre($row['titre']);
            $evt->setDescription($row['description']);
            $evt->setImgPath(ASSETS.$row['img_path']);
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
        $evt->setDateStart(Utils::parseDate($row['date_start']));
        $evt->setDateEnd(Utils::parseDate($row['date_end']));
        $evt->setTypeID($row['id_type']);
        $evt->setTypeName($row['name']);
        $evt->setPlaces($row['places']);
        $evt->setLieu($row['lieu']);

        return $evt;
    }

    /**
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

        var_dump($req->rowCount());
        return $req->rowCount() == 1;
    }

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
