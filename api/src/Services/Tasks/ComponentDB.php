<?php


namespace App\Services\Tasks;

use App\Core\Tasks\TasksInterface;
use App\Entity\Tasks;
use Doctrine\ORM\EntityManager;

/**
 * Class ComponentDB - работа с базой данных по задачам
 * @package App\Services\Tasks
 */
class ComponentDB implements TasksInterface
{
    /**
     * Менеджер работы с БД.
     * @var EntityManager
     */
    private EntityManager $em;

    /**
     * ComponentDB constructor.
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
        $result = [];
        foreach ($this->em->getRepository(Tasks::class)->findAll() as $task) {
            $result[] = $task->toArray();
        }

        return $result;
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
        $this->em->getRepository(Tasks::class)->update($task);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function create(Tasks $task): bool
    {
        return true;
    }
}