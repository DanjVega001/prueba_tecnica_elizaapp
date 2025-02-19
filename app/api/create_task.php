<?php
require_once './task/Task.php';
require_once './task/TaskController.php';


header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    return;
}

$data = json_decode(file_get_contents("php://input"), true);

$taskController = new TaskController(new TaskModel());
$res = $taskController->createTask($data['description'], false);

if (is_array($res)){
    http_response_code(422);
    echo json_encode($res);
}

if (!$res) {
    echo json_encode(["error" => "Fallo al crear el registro"]);
} else {
    http_response_code(200);
    echo json_encode(["message" => 'Tarea registrada exitosamente']);
}
