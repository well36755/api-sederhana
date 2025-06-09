<?php
header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];
$path = isset($_GET["path"]) ? $_GET["path"] : "";

// Parsing path
$pathParts = explode("/", $path);
$resource = isset($pathParts[0]) ? $pathParts[0] : "";
$id = isset($pathParts[1]) ? (int)$pathParts[1] : 0;

if ($resource !== "users") {
    http_response_code(404);
    echo json_encode(["error" => "Resource tidak ditemukan"]);
    exit;
}

// Untuk DELETE, ID akan diambil dari form-data, jadi tidak perlu $id dari path
switch ($method) {
    case "GET":
        require_once "get_users.php";
        break;
    case "POST":
        require_once "post_user.php";
        break;
    case "PUT":
        require_once "put_user.php";
        break;
    case "DELETE":
        require_once "delete_user.php";
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Metode tidak diizinkan"]);
        break;
}
?>