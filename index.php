<?php
ini_set('display_errors', 1); // set to 0 for production version
error_reporting(E_ALL);
$request = $_SERVER['REQUEST_URI'];
echo $request;
switch ($request) {
    case '/blog_admin' :
        require __DIR__ . '/login.php';
        break;
    case '/blogs' :
        require __DIR__ . '/blogs.php';
        break;
    case '/fullblog' :
        require __DIR__ . '/fullblog.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/404.php';
        break;
}
?>
