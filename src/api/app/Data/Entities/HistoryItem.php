<?php

namespace src\Data\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 * @ORM\HasLifecycleCallbacks
 */
class HistoryItem implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $time;

    /**
     * @ORM\Column(type="string")
     */
    private string $value;

    /**
    * @ORM\ManyToOne(targetEntity="Info", inversedBy="historyItems")
    */
    private Info $info;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTime(): DateTime
    {
        return $this->time;
    }

    public function setTime(DateTime $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setInfo(Info $info): void
    {
        $this->info = $info;
    }

    public function getInfo(): Info
    {
        return $this->info;
    }
}