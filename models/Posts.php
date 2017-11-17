<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 16.11.2017 г.
 * Time: 21:44
 */

namespace Microblog\Models;


class Posts extends Database
{
    public function getById($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM posts WHERE id = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAll()
    {
        $sth = $this->conn->prepare("SELECT * FROM posts");
        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($title, $text)
    {
        $sth = $this->conn->prepare("INSERT INTO posts (title, text) VALUES (:title, :text)");
        $sth->bindParam(':title', $title, \PDO::PARAM_STR);
        $sth->bindParam(':text', $text, \PDO::PARAM_STR);
        $result = $sth->execute();

        return $result;
    }
}