<?php

class Task
{
    public ?int $id;
    public ?string $description;
    public bool $completed;

    public function __construct(?int $id, ?string $description, bool $completed)
    {
        $this->id = $id;
        $this->description = $description;
        $this->completed = $completed;
    }

    public function validate(): array|true
    {
        if (!isset($this->description)) {
            return [
                'error' => 'La Tarea necesita una descripción',
            ];
        }
        return true;
    }

    public static function fromArray(array $data): Task
    {
        return new self($data['id'], $data['description'], (bool) $data['completed']);
    }


}