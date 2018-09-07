<?php

/**
 * Created by PhpStorm.
 * User: Eliket-Grp
 * Date: 05/09/2018
 * Time: 00:22
 */
namespace AppBundle\Extra;
use AppBundle\Entity\Brand;
use Symfony\Component\Form\AbstractType;

class VehicleSearch extends AbstractType
{
    /**
     * @var Brand
     */
    private $brand;


    /**
     * @var string
     */
    private $model;


    /**
     * @var State
     */
    private $state;


    /**
     * @var string
     */
    private $minYear;

    /**
     * @var string
     */
    private $maxYear;


    /**
     * @var string
     */
    private $minPrice;

    /**
     * @return string
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param string $maxPrice
     * @return VehicleSearch
     */
    public function setMaxPrice(string $maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @var string
     */
    private $maxPrice;


    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return VehicleSearch
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return VehicleSearch
     */
    public function setModel($model)
    {
        $this->model = $model;
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
     * @return VehicleSearch
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getMinYear()
    {
        return $this->minYear;
    }

    /**
     * @param string $minYear
     * @return VehicleSearch
     */
    public function setMinYear($minYear)
    {
        $this->minYear = $minYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaxYear()
    {
        return $this->maxYear;
    }

    /**
     * @param string $maxYear
     * @return VehicleSearch
     */
    public function setMaxYear($maxYear)
    {
        $this->maxYear = $maxYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param string $minPrice
     * @return VehicleSearch
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
        return $this;
    }


}