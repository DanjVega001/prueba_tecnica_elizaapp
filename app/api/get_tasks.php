<?php
require './task/TaskModel.php';
require './task/TaskController.php';


header("Access-Control-Allow-Methods: GET");

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    return;
}

$controller = new TaskController(new TaskModel());

echo json_encode($controller->getTasks());
