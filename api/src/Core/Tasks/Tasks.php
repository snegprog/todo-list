<?php

declare(strict_types=1);

namespace App\Core\Tasks;


use App\Entity\Task;
use App\Services\Tasks\ComponentDB;
use Doctrine\ORM\EntityManager;

/**
 * Сервси работы с задачами верхнего уровня декоратора
 * Class Task
 * @package App\Core\Tasks
 */
class Tasks implements TasksInterface
{
    /**
     * Менеджер работы с БД.
     * @var EntityManager
     */
    private EntityManager $em;

    /**
     * Task constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): ?Task
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): iterable
    {
        return $this->createDecorator()->getAll();
    }

    /**
     * @inheritDoc
     */
    public function getByStatus(): iterable
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function update(Task $task): bool
    {
        return $this->createDecorator()->update($task);
    }

    /**
     * @inheritDoc
     */
    public function create(Task $task): bool
    {
        return true;
    }

    /**
     * Формируем нужный нам декоратор
     * @return TasksInterface
     */
    private function createDecorator(): TasksInterface
    {
       return new ComponentDB($this->em);
    }
}