<?php
require './task/TaskModel.php';
require './task/TaskController.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    return;
}

$id = $_GET["task_id"];
$controller = new TaskController(new TaskModel());
$res = $controller->completeTask($id);

if ($res) {
    http_response_code(200);
    echo json_encode(["success" => true]);
} else {
    http_response_code(400);
    echo json_encode(["success" => false]);
}
