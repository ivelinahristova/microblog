<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 19.11.2017 г.
 * Time: 19:34
 */

use Microblog\Models\Users;

$app->hook('slim.before.dispatch', function () use ($app) {
    // Restrict admin routes for only logged users
    if(strpos($app->request->getResourceUri(), '/admin') !== false) {
        if((!isset($_SESSION['userId']) || !$_SESSION['userId']) && ($app->request->getResourceUri() !== $app->urlFor('login'))) {
            $app->redirectTo('login');
        }

        if((isset($_SESSION['userId']) && $_SESSION['userId']) && ($app->request->getResourceUri() !== $app->urlFor('changepass'))) {
            $usersModel = new Users($app);
            $user = $usersModel->getById($_SESSION['userId']);

            if($user['password_changed'] == 0) {
                $app->redirectTo('changepass');
            }
        }
    }
});