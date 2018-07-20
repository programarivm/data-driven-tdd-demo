<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="team")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $stadium;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $season;

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setStadium(string $stadium): void
    {
        $this->stadium = $stadium;
    }

    public function getStadium(): string
    {
        return $this->stadium;
    }

    public function setSeason(string $season): void
    {
        $this->season = $season;
    }

    public function getSeason(): string
    {
        return $this->season;
    }
}
