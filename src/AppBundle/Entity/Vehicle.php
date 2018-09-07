<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehicleRepository")
 */
class Vehicle
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
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;


    /**
     * @var string
     * @ORM\Column(name="text_description", type="text")
     */
    private $textDescription;

    /**
     * @return string
     */
    public function getTextDescription()
    {
        return $this->textDescription;
    }

    /**
     * @param string $textDescription
     * @return Vehicle
     */
    public function setTextDescription($textDescription)
    {
        $this->textDescription = $textDescription;
        return $this;
    }



    /**
     * @var Comfort
     * @ORM\ManyToMany(targetEntity="Comfort")
     */
    private $comfort;

     /**
     * @var State
     * @ORM\ManyToOne(targetEntity="State")
     */
    private $state;

    /**
     * @var Media
     * @ORM\ManyToMany(targetEntity="Media")
     */
    private $medias;
    /**
     * @var Security
     * @ORM\ManyToMany(targetEntity="Security")
     */
    private $securities;

    /**
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return Vehicle
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @var Type
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Type")
     */
    private $type;


    /**
     * @return Transmission
     */
    public function getTransmission()
    {
        return $this->transmission;
    }

    /**
     * @param Transmission $transmission
     * @return Vehicle
     */
    public function setTransmission($transmission)
    {
        $this->transmission = $transmission;
        return $this;
    }

    /**
     * @var Transmission
     * @ORM\ManyToOne(targetEntity="Transmission")
     */
    private $transmission;


    /**
     * @var Energy
     * @ORM\ManyToOne(targetEntity="Energy")
     */
    private $energy;

    /**
     * @var Brand
     * @ORM\ManyToOne(targetEntity="Brand")
     */
    private $brand;


    /**
     * @var array
     * @ORM\Column(name="images", type="json_array", nullable=true)
     */
    private $images;


    /**
     * @var Dealer
     * @ORM\ManyToOne(targetEntity="Dealer")
     */
    private $dealer;


    /**
     * @var string
     * @ORM\Column(name="kilometers", type="string", length=255, nullable=true)
     */
    private $kilometers;

    /**
     * @var string
     *
     * @ORM\Column(name="exteriorColour", type="string", length=255)
     */
    private $exteriorColour;

    /**
     * @var string
     *
     * @ORM\Column(name="interiorColour", type="string", length=255)
     */
    private $interiorColour;

    /**
     * @var int
     *
     * @ORM\Column(name="place", type="integer")
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="cylindre", type="string", length=255)
     */
    private $cylindre;


    /**
     * @var int
     *
     * @ORM\Column(name="door", type="integer")
     */
    private $door;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;


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
     * Set model
     *
     * @param string $model
     *
     * @return Vehicle
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Vehicle
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set exteriorColour
     *
     * @param string $exteriorColour
     *
     * @return Vehicle
     */
    public function setExteriorColour($exteriorColour)
    {
        $this->exteriorColour = $exteriorColour;

        return $this;
    }

    /**
     * Get exteriorColour
     *
     * @return string
     */
    public function getExteriorColour()
    {
        return $this->exteriorColour;
    }

    /**
     * Set interiorColour
     *
     * @param string $interiorColour
     *
     * @return Vehicle
     */
    public function setInteriorColour($interiorColour)
    {
        $this->interiorColour = $interiorColour;

        return $this;
    }

    /**
     * Get interiorColour
     *
     * @return string
     */
    public function getInteriorColour()
    {
        return $this->interiorColour;
    }

    /**
     * Set place
     *
     * @param integer $place
     *
     * @return Vehicle
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set cylindre
     *
     * @param string $cylindre
     *
     * @return Vehicle
     */
    public function setCylindre($cylindre)
    {
        $this->cylindre = $cylindre;

        return $this;
    }

    /**
     * Get cylindre
     *
     * @return string
     */
    public function getCylindre()
    {
        return $this->cylindre;
    }


    /**
     * Set door
     *
     * @param integer $door
     *
     * @return Vehicle
     */
    public function setDoor($door)
    {
        $this->door = $door;

        return $this;
    }

    /**
     * Get door
     *
     * @return int
     */
    public function getDoor()
    {
        return $this->door;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Vehicle
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Vehicle
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getKilometers()
    {
        return $this->kilometers;
    }

    /**
     * @param string $kilometers
     * @return Vehicle
     */
    public function setKilometers($kilometers)
    {
        $this->kilometers = $kilometers;
        return $this;
    }

    /**
     * @return Comfort
     */
    public function getComfort()
    {
        return $this->comfort;
    }

    /**
     * @param Comfort $comfort
     * @return Vehicle
     */
    public function setComfort($comfort)
    {
        $this->comfort = $comfort;
        return $this;
    }


    /**
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param State $state
     * @return Vehicle
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return Media
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param Media $medias
     * @return Vehicle
     */
    public function setMedias($medias)
    {
        $this->medias = $medias;
        return $this;
    }

    /**
     * @return Security
     */
    public function getSecurities()
    {
        return $this->securities;
    }

    /**
     * @param Security $securities
     * @return Vehicle
     */
    public function setSecurities($securities)
    {
        $this->securities = $securities;
        return $this;
    }

    /**
     * @return Energy
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * @param Energy $energy
     * @return Vehicle
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;
        return $this;
    }

    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return Vehicle
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     * @return Vehicle
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Dealer
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * @param Dealer $dealer
     * @return Vehicle
     */
    public function setDealer($dealer)
    {
        $this->dealer = $dealer;
        return $this;
    }


}

