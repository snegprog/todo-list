<?php


namespace App\Services\Tasks;

use App\Core\Tasks\TasksInterface;
use App\Entity\Task;
use Doctrine\ORM\EntityManager;

/**
 * Компонент работы с БД по задачам
 * Class ComponentDB
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
    public function get(int $id): ?Task
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): iterable
    {
        $result = [];
        foreach ($this->em->getRepository(Task::class)->findAll() as $task) {
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
    public function update(Task $task): bool
    {
        $this->em->getRepository(Task::class)->update($task);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function create(Task $task): bool
    {
        return true;
    }
}