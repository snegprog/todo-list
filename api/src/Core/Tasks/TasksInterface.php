<?php


namespace App\Core\Tasks;

use App\Entity\Tasks;

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
     * @return Tasks|null
     */
    public function get(int $id): ?Tasks;

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
     * @param Tasks $task
     * @return bool
     */
    public function update(Tasks $task): bool;

    /**
     * Создаем задачу
     * @param Tasks $task
     * @return bool
     */
    public function create(Tasks $task): bool;
}