<?php

require_once 'TaskModel.php';
require_once 'Task.php';


class TaskController
{

    private TaskModel $task;

    public function __construct(TaskModel $task)
    {
        $this->task = $task;
    }

    public function getTasks(): array
    {
        return $this->task->getTasks();
    }

    public function createTask(string $description, bool $status): bool|array
    {
        $taskToStore = new Task(null, $description, $status);
        if (is_array($taskToStore->validate())) {
            return $taskToStore->validate();
        }
        return $this->task->createTask($taskToStore);
    }

    public function updateTask(int $taskId, string $description, bool $status): bool
    {
        $taskToUpdate = new Task($taskId, $description, $status);
        if (is_array($taskToUpdate->validate())) {
            return $taskToUpdate->validate();
        }
        return $this->task->updateTask($taskToUpdate);
    }

    public function deleteTask(int $taskId): bool
    {
        $taskToDelete = new Task($taskId, null, false);
        return $this->task->deleteTask($taskToDelete);
    }

    public function completeTask(int $taskId): bool
    {
        $task = $this->task->getTaskById($taskId);
        return $this->task->completeTask($task);
    }
}