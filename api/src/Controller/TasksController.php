<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Tasks\TasksInterface;
use App\Entity\Tasks;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class TasksController - web контроллер работы с Todo-List
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
     * Менеджер работы с БД.
     * @var LoggerInterface
     * @Inject logger
     */
    protected LoggerInterface $logget;

    /**
     * Менеджер работы с БД.
     * @var TasksInterface
     * @Inject tasks
     */
    protected TasksInterface $tasks;

    public function getTodoList(): iterable
    {
        $this->logget->info('TasksController::getTodoList');

        return $this->tasks->getAll();
    }

    public function status(ServerRequestInterface $request, array $args): iterable
    {
        $this->logget->info('TasksController::status');

        $task = $this->em->getRepository(Tasks::class)->find((int)$args['id']);
        if(!$task) {
            throw new \InvalidArgumentException('Не найдена задача', 400);
        }


        $task->setStatus((int)$args['status']);
        $this->tasks->update($task);

        return ['status' => 'ok'];
    }
}