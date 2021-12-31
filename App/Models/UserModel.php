<?php

namespace App\Models;

use App\Entities\User;
use \App\Utils\BDD;
use \PDO;

class UserModel extends BDD{

    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    /**
     * Methode pour savoir si un Utilisateur existe en fonction d'un mail
     *
     * @param $mail
     * @return mixed
     */
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
     * Methode pour compter le nombre d'Utilisateur par type (all | avec reservation | sans reservation | admin | user)
     *
     * @return mixed
     */
    public function count($type = 'all') {
        switch ($type) {
            case 'all':
                $sql = "select count(id_user) as count from users";
                break;
            case 'resa':
                $sql = "select count(id_user) as count 
                    from users
                    where exists (
                        select null 
                        from reservations 
                        where user_id = users.id_user
                        );";
                break;
            case 'not_resa':
                $sql = "select count(id_user) as count 
                    from users
                    where not exists (
                        select null 
                        from reservations 
                        where user_id = users.id_user
                        );";
                break;
            case 'admin':
                $sql = "select count(id_user) as count from users where type = 'admin'";
                break;
            case 'user':
                $sql = "select count(id_user) as count from users where type = 'user'";
                break;
        }

        $req = $this->pdo->prepare($sql);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    /**
     * Methode pour récupérer les Utilisateurs en fonction du type (all | avec reservation | admin | user )
     *
     * @param int $limit
     * @return array
     */
    public function find($limit = 1000, $offset = 0, $type = 'all') {
        $sql = "select * from users 
                    order by create_at desc 
                    limit {$limit} offset {$offset}";

        if ($type === 'resa') {
            $sql = "select id_user, nom, prenom, mail, password, type, create_at from users u
                        where exists(
                            select * from reservations r 
                                where r.user_id = u.id_user
                            )
                        order by u.create_at desc 
                        limit {$limit} offset {$offset}";
        } elseif ($type === 'admin') {
            $sql = "select * from users 
                        where type = 'admin' 
                        order by create_at desc 
                        limit {$limit} offset {$offset}";
        } elseif ($type === 'user') {
            $sql = "select * from users 
                        where type = 'user' 
                        order by create_at desc 
                        limit {$limit} offset {$offset}";
        }

        $req = $this->pdo->prepare($sql);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $user = new User();
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

    /**
     * Methode pour récupérer un Utilisateur en fonction d'un mail
     *
     * @param $mail
     * @return User
     */
    public function findOne($mail) {
        $sql = "select * from users
                    where mail = :email";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':email', $mail);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);
        $user = new User();

        $user->setId($row['id_user']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setMail($row['mail']);
        $user->setType($row['type']);
        $user->setPassword($row['password']);
        $user->setCreateAt($row['create_at']);

        return $user;
    }

    /**
     * Methode pour créer un Utilisateur
     *
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $hash
     * @return bool
     */
    public function create($nom, $prenom, $mail, $hash) {
        $sql = "insert into users (nom, prenom, mail, password, type) values (:nom, :prenom, :mail, :hash, 'user')";

        $req = $this->pdo->prepare($sql);
        $req->bindValue(':nom', $nom);
        $req->bindValue(':prenom', $prenom);
        $req->bindValue(':mail', $mail);
        $req->bindValue(':hash', $hash);
        return $req->execute();
    }

    /**
     * Methode pour supprimer un Utilisateur
     *
     * @param $id
     * @return bool
     */
    public function deleteOne($id) {
        $sql = "delete from users u where id_user = :user;";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':user', $id);

        $req->execute();

        return $req->rowCount() == 1;
    }
}