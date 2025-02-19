<?php

require_once 'Task.php';
require_once __DIR__ . '/../../database/database.php';


class TaskModel
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getTasks() : array
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, description, completed FROM tasks");
            $stmt->execute();
            $tasks = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $task = Task::fromArray($row);
                $tasks[] = $task;
            }
            return $tasks;
        } catch (PDOException $e) {
            http_response_code(500);
            return ["error" => $e->getMessage()];
        }
    }

    public function createTask(Task $task) : bool
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tasks (description, completed) VALUES (:description, :completed)");
            return $stmt->execute(array(':description' => $task->description, ':completed' => $task->completed ? 1 : 0));
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }

    public function updateTask(Task $task) : bool
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tasks SET description = :description WHERE id = :id");
            return $stmt->execute(["description" => $task->description, "id" => $task->id]);
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }

    public function deleteTask(Task $task) : bool
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = :id");
            return $stmt->execute(['id' => $task->id]);
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }

    public function getTaskById(int $id) : Task | bool
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, description, completed FROM tasks WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return Task::fromArray($row);
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }

    public function completeTask(Task $task) : bool
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tasks SET completed = :completed WHERE id = :id");
            return $stmt->execute(['id' => $task->id, 'completed' => $task->completed ? 0 : 1]);
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }
}