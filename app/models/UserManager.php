<?php

/**
 * Class UserManager
 */
class UserManager extends BDD{

    private $pdo;

    /**
     * UserManager constructor.
     */
    public function __construct() {
        $this->pdo = $this->connect();
    }

    public function exists($mail) {
        $sql = "select * from users
                    where mail = :email";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':email', $mail);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     * @return mixed
     */
    public function count() {
        $sql = "select count(id_user) as count from users";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    public function countByReservation($reserved) {
        $sql = !$reserved?
            "select count(id_user) as count 
                from users
                where exists (
                    select null 
                    from reservations 
                    where user_id = users.id_user
                    );" :
            "select count(id_user) as count 
                from users
                where not exists (
                    select null 
                    from reservations 
                    where user_id = users.id_user
                    );";

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
        $sql = "select * from users limit {$limit}";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $user = new UserObject();
            $user->setId($row['id_user']);
            $user->setNom($row['nom']);
            $user->setPrenom($row['prenom']);
            $user->setMail($row['mail']);
            $user->setType($row['type']);
            $user->setPassword($row['password']);
            $user->setCreateAt($row['create_at']);

            $users[] = $user;
        }

        return $users;
    }

    public function find($mail) {
        $sql = "select * from users
                    where mail = :email";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':email', $mail);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);
        $user = new UserObject();

        $user->setId($row['id_user']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setMail($row['mail']);
        $user->setType($row['type']);
        $user->setPassword($row['password']);
        $user->setCreateAt($row['create_at']);

        return $user;
    }

    public function create($nom, $prenom, $mail, $hash) {
        $sql = "insert into users (nom, prenom, mail, password, type) values (:nom, :prenom, :mail, :hash, 'user')";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':hash', $hash);
        return $req->execute();
    }
}