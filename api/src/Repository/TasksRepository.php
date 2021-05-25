<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tasks;
use Doctrine\ORM\EntityRepository;

/**
 * Репозиторий работы с задачами
 * Class TasksRepository
 * @package App\Repository
 */
class TasksRepository extends EntityRepository implements CrudInterface, RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create($tasks): Tasks
    {
        if(!($tasks instanceof Tasks)) { // в php8 подобное не требуется, указать параметр можно
            throw new \InvalidArgumentException('В TasksRepository::create() переданы не корректные данные (тип данных)');
        }
        if ($tasks->getId()) {
            throw new \InvalidArgumentException('В TasksRepository::create() переданы не корректные данные');
        }

        $this->getEntityManager()
            ->persist($tasks);
        $this->getEntityManager()
            ->flush($tasks);

        return $tasks;
    }

    /**
     * @inheritDoc
     */
    public function update($tasks): Tasks
    {
        if(!($tasks instanceof Tasks)) { // в php8 подобное не требуется, указать параметр можно
            throw new \InvalidArgumentException('В TasksRepository::update() переданы не корректные данные (тип данных)');
        }
        if (!$tasks->getId()) {
            throw new \InvalidArgumentException('В TasksRepository::update() переданы не корректные данные (не отследиваемая сущность)');
        }

        $this->getEntityManager()
            ->flush($tasks);

        return $tasks;
    }

    /**
     * @inheritDoc
     */
    public function remove($tasks): Tasks
    {
        if(!($tasks instanceof Tasks)) { // в php8 подобное не требуется, указать параметр можно
            throw new \InvalidArgumentException('В TasksRepository::remove() переданы не корректные данные (тип данных)');
        }
        if (!$tasks->getId()) {
            throw new \InvalidArgumentException('В TasksRepository::remove() переданы не корректные данные');
        }

        $this->getEntityManager()
            ->remove($tasks);
        $this->getEntityManager()
            ->flush($tasks);

        return $tasks;
    }

    /**
     * @inheritDoc
     */
    public function getAllWithSpecifiedKey(string $key = 'id'): ?iterable
    {
        return $this->createQueryBuilder('Tasks', 'Tasks.' . $key)
            ->getQuery()
            ->getResult();
    }
}
