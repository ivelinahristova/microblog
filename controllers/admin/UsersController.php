<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Users;

class UsersController
{
    public function __construct()
    {

    }

    public function login(\Slim\Slim $app){
        $app->render('admin/login.phtml', []);
    }

    public function loginSubmit(\Slim\Slim $app){

        $app->render('admin/login.phtml', ['msg' => 'Success']);
    }
}