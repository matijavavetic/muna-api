<?php

namespace src\Data\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use src\Data\Entities\Contracts\EntityInterface;

/**
 * @ORM\Entity
 * @ORM\Table
 * @ORM\HasLifecycleCallbacks
 */
class Info implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $solved;

    /**
    * @ORM\OneToMany(targetEntity="HistoryItem", mappedBy="info", cascade={"persist"})
    * @var ArrayCollection
    */
    private $historyItems;

    /**
     * @ORM\Column(type="string")
     */
    private string $userId;

    public function __construct()
    {
        $this->historyItems = new ArrayCollection;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSolved(): bool
    {
        return $this->solved;
    }

    public function setSolved(bool $solved): self
    {
        $this->solved = $solved;

        return $this;
    }

    public function addHistoryItem(HistoryItem $historyItem): void
    {
        if (! $this->historyItems->contains($historyItem)) {
            $historyItem->setInfo($this);
            $this->historyItems->add($historyItem);
        }
    }

    public function getHistoryItems(): ArrayCollection
    {
        return $this->historyItems;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}