<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transmission
 *
 * @ORM\Table(name="transmission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransmissionRepository")
 */
class Transmission
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(name="title",type="string", length=255)
     */
    private $title;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Transmission
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}

