<?php


namespace App\Core\Tasks;

use App\Entity\Task;

/**
 * Интерфейс взаимодействия с задачами
 * Interface TasksInterface
 * @package App\Core\Tasks
 */
interface TasksInterface
{
    /**
     * Возвращаем задачу по ID
     * @param int $id
     * @return Task|null
     */
    public function get(int $id): ?Task;

    /**
     * Возвращаем все задачи
     * @return iterable
     */
    public function getAll(): iterable;

    /**
     * Возвращаем задачи по статусу
     * @return iterable
     */
    public function getByStatus(): iterable;

    /**
     * Обновляем задачу
     * @param Task $task
     * @return bool
     */
    public function update(Task $task): bool;

    /**
     * Создаем задачу
     * @param Task $task
     * @return bool
     */
    public function create(Task $task): bool;
}