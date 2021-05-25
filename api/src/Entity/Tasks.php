<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Таблица с задачами
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="App\Repository\TasksRepository")
 */
class Tasks extends MappedSuperclassDate implements EntityInterface
{
    /**
     * Статус задачи "Новая"
     */
    private const STATUS_NEW = 0;

    /**
     * Статус задачи "В работе"
     */
    private const STATUS_IN_PROGRESS = 1;

    /**
     * Статус задачи "В ожидании"
     */
    private const STATUS_WAIT = 2;

    /**
     * Статус задачи "Выполнена"
     */
    private const STATUS_DONE = 3;

    /**
     * Массив для проверки корректности статуса
     */
    private const STATUSES = [
        self::STATUS_NEW => true,
        self::STATUS_IN_PROGRESS => true,
        self::STATUS_WAIT => true,
        self::STATUS_DONE => true,
    ];

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=512, nullable=false, options={"comment"="Название задачи"})
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=2048, nullable=false, options={"comment"="Описание задачи"})
     */
    private string $description;

    /**
     * @var int
     * @ORM\Column(name="status", type="integer", nullable=false, options={"unsigned"=true})
     */
    private int $status;

    /**
     * Возвращаем название задачи
     * @return string
     */
    public function getName(): string
    {
        return empty($this->name) ? '': $this->name;
    }

    /**
     * Устанвливаем название задачи
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Возвращаем описание задачи
     * @return string
     */
    public function getDescription(): string
    {
        return empty($this->description) ? '': $this->description;
    }

    /**
     * Устанавливаем описание задачи
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Возвращаем статус задачи
     * @return int - -1|key self::STATUSES (-1 если статус не определен)
     */
    public function getStatus(): int
    {
        return empty($this->status) ? -1: $this->status;
    }

    /**
     * Устанваливаем статус задачи
     * @param int $status - статус задачи
     * @throws \InvalidArgumentException
     */
    public function setStatus(int $status): self
    {
        if (!isset(self::STATUSES[$status])) {
            throw new \InvalidArgumentException('Не корректный статус');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Возвращаем данные задачи в виде массива
     * @return array
     */
    public function toArray(): iterable
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'createAt' => $this->getCreateAt(),
            'updateAt' => $this->getUpdateAt(),
        ];
    }
}