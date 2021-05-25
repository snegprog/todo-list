<?php

declare(strict_types=1);

namespace App\Core\Tasks;


use App\Entity\Tasks;
use App\Services\Tasks\ComponentDB;
use Doctrine\ORM\EntityManager;

/**
 * Сервси работы с задачами верхнего уровня декоратора
 * Class Task
 * @package App\Core\Tasks
 */
class Task implements TasksInterface
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
    public function get(int $id): ?Tasks
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
    public function update(Tasks $task): bool
    {
        return $this->createDecorator()->update($task);
    }

    /**
     * @inheritDoc
     */
    public function create(Tasks $task): bool
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