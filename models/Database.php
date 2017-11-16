<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 15.11.2017 г.
 * Time: 6:51
 */

namespace Microblog\Models;


abstract class Database
{
    protected $conn;

    public function __construct($app)
    {
        $db_settings = $app->container['settings']['db'];
        $this->conn = new \PDO("mysql:host=localhost;dbname={$db_settings['dbname']}", $db_settings['user'], $db_settings['password'] );
    }

    abstract public function getById($id);

    abstract public function getAll();

}