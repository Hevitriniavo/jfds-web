<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function include_component(string $relativePathWithoutExtension, array $props = []): string
{
    $filePath = RESOURCE_PATH . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $relativePathWithoutExtension . '.php';

    return file_exists($filePath)
        ? (function () use ($filePath, $props) {
            ob_start();
            extract($props);
            include $filePath;
            return ob_get_clean();
        })()
        : "Component not found: $filePath";
}

function views(string $templateName, array $variables = []): string
{
    $viewPath = getViewPath($templateName);
    $jsPath = getJsPath($templateName);
    $cssPath = getCssPath($templateName);
    $baseLayoutPath = getBaseLayoutPath();

    if (!file_exists($viewPath)) {
        return "The view '$templateName' does not exist.";
    }

    extract($variables);

    ob_start();
    require $viewPath;
    $content = ob_get_clean();

    $style = '';
    if (file_exists($cssPath)) {
        $style = file_get_contents($cssPath);
    }

    $script = '';
    if (file_exists($jsPath)) {
        $script = file_get_contents($jsPath);
    }

    if (!file_exists($baseLayoutPath)) {
        return "The base layout file '$baseLayoutPath' does not exist.";
    }

    ob_start();
    require $baseLayoutPath;
    return ob_get_clean();
}

function getViewPath(string $templateName): string
{
    return RESOURCE_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $templateName . '.php';
}

function getJsPath(string $templateName): string
{
    return RESOURCE_PATH . DIRECTORY_SEPARATOR . "js" . DIRECTORY_SEPARATOR . getNameJSAndCss($templateName) . '.js';
}

function getCssPath(string $templateName): string
{
    return RESOURCE_PATH . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . getNameJSAndCss($templateName) . '.css';
}

function getBaseLayoutPath(): string
{
    return RESOURCE_PATH . DIRECTORY_SEPARATOR . 'base.php';
}

function getNameJSAndCss(string $viewPath): string
{
    if (str_contains($viewPath, ".view")) {
        return str_replace(".view", "", $viewPath);
    }
    return $viewPath;
}

function toJson(array $data): string
{
    return json_encode($data);
}

function pubUrl(string $pubPath): string
{
    return sprintf(
        '%s://%s/%s',
        !empty($_SERVER['HTTPS']) ? 'https' : 'http',
        $_SERVER['HTTP_HOST'],
        ltrim($pubPath, '/')
    );
}


function path(string $route, array $params = []): string
{
    return !empty($params)
        ? $route . '/' . implode('/', $params)
        : $route;
}

function redirect(string $path, int $statusCode = 200, array $messages = []): void
{
    http_response_code($statusCode);
    if (isset($messages['type']) && isset($messages['message'])) {
        addFlashMessage($messages['type'], $messages['message']);
    }
    header('Location: ' . $path);
    exit();
}


function addFlashMessage(string $type, string $message): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['flash_message'] = [
        'type' => htmlspecialchars($type),
        'message' => htmlspecialchars($message)
    ];
}


function getFlashMessage(): array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $flashMessage;
    }

    return ['type' => '', 'message' => ''];
}



function setSessionValue(string $key, mixed $value): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION[$key] = $value;
}

function getSessionValue(string $key): mixed
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION[$key] ?? null;
}

function removeSessionValue(string $key): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}




