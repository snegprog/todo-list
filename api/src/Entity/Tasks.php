<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="App\Repository\TasksRepository")
 */
class Tasks extends MappedSuperclassDate implements EntityInterface
{
    private const STATUS_NEW = 0;
    private const STATUS_IN_PROGRESS = 1;
    private const STATUS_WAIT = 2;
    private const STATUS_DONE = 3;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
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