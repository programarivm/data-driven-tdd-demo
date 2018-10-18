<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Team.
 *
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $stadium
     */
    public function setStadium(string $stadium): void
    {
        $this->stadium = $stadium;
    }

    /**
     * @return string
     */
    public function getStadium(): string
    {
        return $this->stadium;
    }

    /**
     * @param string $season
     */
    public function setSeason(string $season): void
    {
        $this->season = $season;
    }

    /**
     * @return string
     */
    public function getSeason(): string
    {
        return $this->season;
    }
}
