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
        $sth = $this->conn->prepare("SELECT posts.title, posts.id as post_id, posts.text, posts.datepublished, users.name as author, users.id as author_id FROM posts LEFT JOIN users ON posts.user = users.id WHERE posts.id = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAll()
    {
        $sth = $this->conn->prepare("SELECT posts.title, posts.id as post_id, posts.text, posts.datepublished, users.name as author, users.id as author_id FROM posts LEFT JOIN users ON posts.user = users.id");
        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($title, $text, $userId)
    {
        $sth = $this->conn->prepare("INSERT INTO posts (title, text, `user`) VALUES (:title, :text, :userId)");
        $sth->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $sth->bindParam(':title', $title, \PDO::PARAM_STR);
        $sth->bindParam(':text', $text, \PDO::PARAM_STR);
        $result = $sth->execute();

        return $result;
    }
}