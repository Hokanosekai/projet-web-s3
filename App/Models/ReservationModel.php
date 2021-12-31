<?php

namespace App\Models;

use App\Entities\Evenement;
use \App\Entities\Reservation;
use \App\Utils\BDD;
use \PDO;
use PDOException;

class ReservationModel extends BDD {

    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    /**
     * Methode pour compter les Réservations en fonction d'un type (all | theatre | concert | humour | exposition)
     *
     * @param int $type
     * @return mixed
     */
    public function count($type = 0) {
        $sql = $type === 0?
            "select count(id_res) as count from reservations" :
            "select count(id_res) as count
                from reservations
                join evenements e
                    on reservations.evt_id = e.id_evt
                where e.type = {$type}
                group by e.type;";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    /**
     * Methode permettant de récupérer les Réservations en fonction
     *  - d'un type (all | theatre | concert | humour | exposition)
     *  - d'une date
     *
     * @param false $type
     * @param false $date
     * @return array
     */
    public function countByDate($type = 0, $date = false) {
        if (!$date) {
            $sql = $type === 0 ?
                "select count(id_res) as count, create_at 
                    from reservations
                    group by create_at;" :
                "select count(id_res) as count, create_at
                    from reservations
                    join evenements e
                        on reservations.evt_id = e.id_evt
                    where e.type = {$type}
                    group by create_at;";
        } else {
            $sql = $type === 0 ?
                "select count(id_res) as count, create_at 
                    from reservations
                    where create_at = '{$date}'
                    group by create_at;" :
                "select count(id_res) as count, create_at
                    from reservations
                    join evenements e
                        on reservations.evt_id = e.id_evt
                    where e.type = {$type}
                    where create_at = '{$date}'
                    group by create_at;";
        }

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $reservations = [];

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $reservations[] = [
                "count" => $row['count'],
                "date" => !$date? $row['create_at'] : $date
            ];
        }

        return $reservations;
    }

    /**
     * Methode permettant de récupérer les Réservations ainsi que le detail de la Réservation en fonction de l'id d'un Utilisateur
     *
     * @param $id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findAllByUsers($id, $limit = 1000, $offset = 0) {
        $sql = "select r.evt_id, r.create_at, r.hour, r.date, r.id_res, r.prix, r.user_id, evt_t.name, e.id_evt, e.titre, e.lieu, e.description, e.img_path, e.date_start, e.date_end
                    from reservations r
                    join evenements e on e.id_evt = r.evt_id
                    join users u on u.id_user = r.user_id
                    join evt_types evt_t 
                        on e.type = evt_t.id_type
                    where u.id_user = :user
                    order by r.create_at desc
                    limit {$limit} offset {$offset}";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':user', $id);
        $req->execute();

        $reservations = [];
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $evt = new Evenement();
            $evt->setId($row['id_evt']);
            $evt->setTitre($row['titre']);
            $evt->setLieu($row['lieu']);
            $evt->setImgPath($row['img_path']);
            $evt->setDescription($row['description']);
            $evt->setDateStart($row['date_start']);
            $evt->setDateEnd($row['date_end']);

            $res = new Reservation();
            $res->setId($row['id_res']);
            $res->setUser($id);
            $res->setEvenement($evt);
            $res->setDate($row['date']);
            $res->setHour($row['hour']);
            $res->setPrix($row['prix']);
            $res->setCreateAt($row['create_at']);
            $res->setType($row['name']);
            $res->setPrices([]);

            $sql2 = "select count, total, reservation_id, price_id, p.titre, p.prix from reservations_prices 
                        join prices p on p.id_price = reservations_prices.price_id
                        where reservation_id = :res_id";
            $req2 = $this->pdo->prepare($sql2);
            $req2->bindParam(':res_id', $row['id_res']);
            $req2->execute();

            while ($row2 = $req2->fetch(PDO::FETCH_ASSOC)) {
                $data = [
                    "count" => $row2['count'],
                    "total" => $row2['total'],
                    "price_titre" => $row2['titre'],
                    "price_price" => $row2['prix']
                ];

                $res->addPrice($data);
            }

            $reservations[] = $res;
        }

        return $reservations;
    }

    /**
     * Methode pour récupérer les Réservations en fonction d'un type (all | theatre | concert | humour | exposition)
     *
     * @param int $limit
     * @param int $offset
     * @param int $type
     * @return array
     */
    public function findAll($limit = 1000, $offset = 0, $type = 0) {
        $sql = $type === 0?
            "select r.evt_id, r.create_at, r.hour, r.date, r.id_res, r.prix, r.user_id, u.mail, evt_t.name
                    from reservations r
                    join evenements e on e.id_evt = r.evt_id
                    join users u on u.id_user = r.user_id
                    join evt_types evt_t 
                        on e.type = evt_t.id_type
                    order by r.create_at desc
                    limit {$limit} offset {$offset}":
            "select r.evt_id, r.create_at, r.hour, r.date, r.id_res, r.prix, r.user_id, u.mail, evt_t.name
                    from reservations r
                    join evenements e on e.id_evt = r.evt_id
                    join users u on u.id_user = r.user_id
                    join evt_types evt_t 
                        on e.type = evt_t.id_type
                    where e.type = :typ
                    order by r.create_at desc
                    limit {$limit} offset {$offset}";

        $req = $this->pdo->prepare($sql);
        if ($type != 0)
            $req->bindParam(':typ', $type);
        $req->execute();

        $reservations = [];
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $evt = new Reservation();
            $evt->setId($row['id_res']);
            $evt->setUser($row['mail']);
            $evt->setEvenement($row['evt_id']);
            $evt->setDate($row['date']);
            $evt->setHour($row['hour']);
            $evt->setPrix($row['prix']);
            $evt->setCreateAt($row['create_at']);
            $evt->setType($row['name']);

            $reservations[] = $evt;
        }

        return $reservations;
    }

    /**
     * Methode pour créer une Réservation ainsi que les details du prix
     *
     * @param Reservation $reservation
     * @param $prices_details
     * @return bool
     */
    public function create(Reservation $reservation, $prices_details) {

        $sql = "insert into reservations (user_id, evt_id, prix, date, hour) values (:user, :evt, :prix, :date, :hour);";

        $req = $this->pdo->prepare($sql);

        $user = (int)$reservation->getUser();
        $evt = (int)$reservation->getEvenement();
        $prix = $reservation->getPrix();
        $date = $reservation->getDate();
        $hour = $reservation->getHour();

        $req->bindParam(':user', $user);
        $req->bindParam(':evt', $evt);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':date', $date);
        $req->bindParam(':hour', $hour);

        $req->execute();

        $id = $this->pdo->lastInsertId();
        $sql = "insert into reservations_prices (count, total, price_id, reservation_id) values ";

        for ($i = 0; $i < sizeof($prices_details); $i++) {
            $count = $prices_details[$i]['count'];
            $total = $prices_details[$i]['total'];
            $price_id = (int)$prices_details[$i]['price_id'];

            if ($i === sizeof($prices_details)-1) {
                $sql.=" ({$count}, {$total}, {$price_id}, {$id});";
            } else {
                $sql.=" ({$count}, {$total}, {$price_id}, {$id}),";
            }
        }

        $req2 = $this->pdo->prepare($sql);
        $req2->execute();

        return $req->rowCount() > 0 && $req2->rowCount() > 0;
    }

    /**
     * Methode pour supprimer une Réservation
     *
     * @param $id
     * @return bool
     */
    public function deleteOne($id) {
        $sql = "delete from reservations where id_res = :id;";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();

        return $req->rowCount() == 1;
    }

    /**
     * Méthode pour trouver le Type d'Evenement le plus réservé
     *
     * @return array|false
     */
    public function findMostReservedType() {
        $sql = "select count(id_res) as count, et.name, et.id_type
                from reservations
                join evenements e
                    on reservations.evt_id = e.id_evt
                join evt_types et on et.id_type = e.type
                group by e.type
                order by count(id_res) desc;";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode pour trouver le top 5 des Evenements les plus réservés
     *
     * @return array|false
     */
    public function findMostReservedEvt() {
        $sql = "select count(id_res) as count, e.titre, e.id_evt
                from reservations
                join evenements e
                    on reservations.evt_id = e.id_evt
                group by e.type
                order by count(id_res) desc
                limit 5;";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}