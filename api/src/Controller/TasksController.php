<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Tasks\TasksInterface;
use App\Entity\Tasks;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Web контроллер работы с задачами
 * Class TasksController
 * @package App\Controller
 */
class TasksController extends AbstractController
{
    /**
     * Менеджер работы с БД.
     * @var EntityManager
     * @Inject entityManager
     */
    protected EntityManager $em;

    /**
     * Сервис работы с логом.
     * @var LoggerInterface
     * @Inject logger
     */
    protected LoggerInterface $logget;

    /**
     * Сервис работы с задачами.
     * @var TasksInterface
     * @Inject tasks
     */
    protected TasksInterface $tasks;

    /**
     * Возвращаем полный список задач
     * @return iterable
     */
    public function getTodoList(): iterable
    {
        $this->logget->info('TasksController::getTodoList');

        return $this->tasks->getAll();
    }

    /**
     * Меняем статус задачи
     * @param ServerRequestInterface $request
     * @param array $args
     * @return iterable
     */
    public function status(ServerRequestInterface $request, array $args): iterable
    {
        $this->logget->info('TasksController::status');

        $task = $this->em->getRepository(Tasks::class)->find((int)$args['id']);
        if(!$task) {
            throw new \InvalidArgumentException('Не найдена задача', 400);
        }

        try {
            $task->setStatus((int)$args['status']);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage(), 400);
        }

        $this->tasks->update($task);

        return ['status' => 'ok'];
    }
}