<?php
/**
 * Created by PhpStorm.
 * User: Ivelina
 * Date: 14.11.2017 г.
 * Time: 21:58
 */

namespace Microblog\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DefaultController
{
    private $logger;
    private $renderer;

    public function index($app){
        // Log message
//        $app->log("Slim-Skeleton '/' route");
        // Render index view
        return $app->render('index.phtml');
    }

    public function throwException(RequestInterface $request, ResponseInterface $response, array $args){
//        $this->logger->info("Slim-Skeleton '/throw' route");
        throw new \Exception('testing errors 1.2.3..');
    }
}