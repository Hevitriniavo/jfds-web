<?php

namespace App\Core;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class Router
{
    private array $routes = [];

    public function register(array $route): void
    {
        if (!isset($route['path'], $route['method'], $route['controller'])) {
            echo "Error: Invalid route structure.";
            return;
        }
        $this->routes[] = $route;
    }

    public function run(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if ($route['path'] === $requestUri && strtoupper($route['method']) === $requestMethod) {

                $redirectUrl = $this->runMiddlewares($route['middleware'] ?? []);

                if ($redirectUrl) {
                    header("Location: " . $redirectUrl);
                    exit;
                }

                if ($this->handle($route['controller'])) {
                    return;
                }
                break;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function runMiddlewares(array $middlewares): ?string
    {
        foreach ($middlewares as $middlewareClass) {
            if (!class_exists($middlewareClass)) {
                echo "Error: Middleware class $middlewareClass not found.";
                return null;
            }
            try {
                $reflectionClass = new ReflectionClass($middlewareClass);

                $middlewareInstance = $reflectionClass->newInstance();

                if (!$reflectionClass->hasMethod('check')) {
                    echo "Error: Method 'check' not found in middleware $middlewareClass.";
                    return null;
                }
                $reflectionMethod = $reflectionClass->getMethod('check');
                if (!$reflectionMethod->invoke($middlewareInstance)) {
                    return $this->getRedirectionUrl($reflectionClass);
                }
            } catch (ReflectionException $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }

        return null;
    }

    private function getRedirectionUrl(ReflectionClass $reflectionClass): string
    {
        if ($reflectionClass->hasConstant('REDIRECTION')) {
            return $reflectionClass->getConstant('REDIRECTION');
        }
        return "/";
    }

    private function handle(array $controller): bool
    {
        [$controllerClass, $method] = $controller;

        if (!class_exists($controllerClass)) {
            echo "Error: Controller class $controllerClass not found.";
            return false;
        }

        $controllerInstance = new $controllerClass();

        if (!method_exists($controllerInstance, $method)) {
            echo "Error: Method $method not found in controller $controllerClass.";
            return false;
        }

        try {
            $reflectionMethod = new ReflectionMethod($controllerInstance, $method);
            echo $reflectionMethod->invoke($controllerInstance);
            return true;
        } catch (ReflectionException) {
            echo "Error: Unable to invoke method $method in controller $controllerClass.";
            return false;
        }
    }
}
