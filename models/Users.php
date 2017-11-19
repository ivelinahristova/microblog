<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 16.11.2017 г.
 * Time: 21:44
 */

namespace Microblog\Models;


class Users extends Database
{
    public function getById($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getByEmail($email)
    {
        $sth = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $sth->bindParam(':email', $email);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAll()
    {
        $sth = $this->conn->prepare("SELECT * FROM users");
        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function setLastLogin($id, $sessionId) {
        $datetime = date("Y-m-d H:i:s", time());
        $sth = $this->conn->prepare("UPDATE users SET last_login = :datetime, session_id = :sessionId WHERE id = :id");
        $sth->bindParam(':datetime', $datetime);
        $sth->bindParam(':sessionId', $sessionId);
        $sth->bindParam(':id', $id);
        $res = $sth->execute();

        return $res;
    }

    public function hasValidSession($id) {
        $datetime = date('Y-m-d H:i:s', strtotime('+5 minutes'));
        $sth = $this->conn->prepare("SELECT * FROM users WHERE id = :id AND last_login <= :datetime");
        $sth->bindParam(':datetime', $datetime);
        $sth->bindParam(':id', $id);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPosts($id) {
        $sth = $this->conn->prepare("SELECT * FROM posts WHERE `user` = :userId");
        $sth->bindParam(':userId', $id);
        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}