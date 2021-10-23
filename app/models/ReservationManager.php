<?php


class ReservationManager extends BDD {

    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    /**
     * @param bool $type
     * @return mixed
     */
    public function count($type = false) {
        $sql = !$type?
            "select count(id_res) as count from reservations" :
            "select count(id_res) as count 
                from reservations
                join evenements e 
                    on reservations.evt_id = e.id_evt
                where e.type = {$type}
                group by e.id_evt;";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    public function countByDate($type = false) {
        $sql = !$type?
            "select count(id_res) as count, create_at 
                from reservations
                group by create_at;" :
            "select count(id_res) as count, create_at
                from reservations
                join evenements e
                    on reservations.evt_id = e.id_evt
                where e.type = {$type}
                group by create_at;";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $reservations[] = [
                "count" => $row['count'],
                "date" => $row['create_at']
            ];
        }

        return $reservations;
    }

    public function findAll($limit = 1000) {
        $sql = "select * from reservations r
                    limit {$limit}";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $evt = new ReservationObject();
            $evt->setId($row['id_res']);
            $evt->setUser($row['user_id']);
            $evt->setEvenement($row['evt_id']);
            $evt->setDate($row['date']);
            $evt->setPrix($row['prix']);
            $evt->setCreateAt($row['create_at']);

            $reservations[] = $evt;
        }

        return $reservations;
    }

    public function find($id) {

    }

    public function create() {

    }

    public function delete($id) {

    }

}