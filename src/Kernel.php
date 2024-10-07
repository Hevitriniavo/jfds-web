<?php

namespace App;

use App\Core\Router;
use Dotenv\Dotenv;
use Exception;

class Kernel
{
    private static ?Kernel $instance = null;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        $this->loadEnvironmentVariables();
        $this->defineConstants();
        $this->loadHelpers();
    }

    private function loadEnvironmentVariables(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    private function defineConstants(): void
    {
        define('CONFIG_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
        define('RESOURCE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'resources');
    }

    private function loadHelpers(): void
    {
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'helpers.php';
    }

    public static function getInstance(): Kernel
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function run(): void
    {
        $router = new Router();
        $routes = require(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'index.php');
        foreach ($routes as $route) {
            $router->register($route);
        }
        $router->run();
    }

}
