<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Task;
use Doctrine\ORM\EntityRepository;

/**
 * Репозиторий работы с задачами
 * Class TaskRepository
 * @package App\Repository
 */
class TaskRepository extends EntityRepository implements CrudInterface, RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create($task): Task
    {
        if(!($task instanceof Task)) { // в php8 подобное не требуется, указать параметр можно
            throw new \InvalidArgumentException('В TaskRepository::create() переданы не корректные данные (тип данных)');
        }
        if ($task->getId()) {
            throw new \InvalidArgumentException('В TaskRepository::create() переданы не корректные данные');
        }

        $this->getEntityManager()
            ->persist($task);
        $this->getEntityManager()
            ->flush($task);

        return $task;
    }

    /**
     * @inheritDoc
     */
    public function update($task): Task
    {
        if(!($task instanceof Task)) { // в php8 подобное не требуется, указать параметр можно
            throw new \InvalidArgumentException('В TaskRepository::update() переданы не корректные данные (тип данных)');
        }
        if (!$task->getId()) {
            throw new \InvalidArgumentException('В TaskRepository::update() переданы не корректные данные (не отследиваемая сущность)');
        }

        $this->getEntityManager()
            ->flush($task);

        return $task;
    }

    /**
     * @inheritDoc
     */
    public function remove($task): Task
    {
        if(!($task instanceof Task)) { // в php8 подобное не требуется, указать параметр можно
            throw new \InvalidArgumentException('В TaskRepository::remove() переданы не корректные данные (тип данных)');
        }
        if (!$task->getId()) {
            throw new \InvalidArgumentException('В TaskRepository::remove() переданы не корректные данные');
        }

        $this->getEntityManager()
            ->remove($task);
        $this->getEntityManager()
            ->flush($task);

        return $task;
    }

    /**
     * @inheritDoc
     */
    public function getAllWithSpecifiedKey(string $key = 'id'): ?iterable
    {
        return $this->createQueryBuilder('Task', 'Task.' . $key)
            ->getQuery()
            ->getResult();
    }
}
