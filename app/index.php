<?php
require_once 'database/migration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./frontend/css/styles.css">
    <title>TasksApp</title>
</head>
<body>
    <div id="main">
        <div>
            <h1>Lista de Tareas</h1>
            <form id="form_create_task">
                <label for="input_task"></label>
                <input required type="text" name="task" id="input_task">
                <button type="submit">Agregar</button>
            </form>
        </div>

        <div class="container">

        </div>
    </div>


    <script type="module" src="frontend/js/create_task.js"></script>
    <script type="module" src="frontend/js/get_tasks.js"></script>
    <script type="module" src="frontend/js/delete_task.js"></script>

</body>
</html>

