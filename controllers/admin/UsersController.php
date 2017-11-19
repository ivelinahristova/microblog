<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers\Admin;

use Microblog\Models\Users;
use Slim\Slim;

class UsersController extends DefaultController
{
    public function login(Slim $app){
        $app->render('admin/login.phtml', $this->params);
    }

    public function loginSubmit(Slim $app){
        $usersModel = new Users($app);
        $formData = $app->request->post();
        $email = $formData['email'];
        $password = $formData['password'];
        $user = $usersModel->getByEmail($email);

        if($user && $user['password'] && password_verify($password, $user['password'])) {
            session_regenerate_id();
            $sessionId = session_id();
            $_SESSION['userId'] = $user['id'];
            $usersModel->setLastLogin($user['id'], $sessionId);
        }

        $app->redirectTo('dashboard');
    }

    public function logout(Slim $app) {
        session_unset();
        session_regenerate_id();

        $app->redirectTo('login');
    }

    public function lists(Slim $app) {
        $usersModel = new Users($app);
        $users = $usersModel->getAll();
        $this->params['users'] = $users;

        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/users/list.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }

    public function add(Slim $app){
        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/users/add.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }

    public function addSubmit(Slim $app){
        $usersModel = new Users($app);
        $formData = $app->request->post();
        $name = $formData['name'];
        $email = $formData['email'];
        $password = $this->randomStr(10);
        $usersModel->insert($name, $email, password_hash($password,PASSWORD_DEFAULT));

        $subject = 'You are now an administrator in the coolest Microblog';
        $message = "Your temporary password is: {$password}. As soon as you visit the coolest Microblog you will be forced to change your password.";
        mail($email, $subject, $message);

        $app->redirectTo('usersLists');
    }

    public function changepass(Slim $app){
        $app->render('admin/header.phtml', $this->params);
        $app->render('admin/users/changepass.phtml', $this->params);
        $app->render('admin/footer.phtml', []);
    }

    public function changepassSubmit(Slim $app){
        $usersModel = new Users($app);
        $formData = $app->request->post();
        $password = $formData['password'];
        $passwordConfirm = $formData['password_confirm'];
        if($password === $passwordConfirm) {
            $usersModel->changepass(password_hash($password,PASSWORD_DEFAULT), $this->userId);
        } else {
            $app->redirectTo('changepass');
        }

        $app->redirectTo('usersLists');
    }

    private function randomStr($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($keyspace);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $keyspace[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}