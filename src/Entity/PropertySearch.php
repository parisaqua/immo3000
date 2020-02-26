<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch {

    /**
     * @Assert\Range(
     *      min = 11,
     *      max = 750
     * )
     * @var int|null
     */
    private $maxSurface;

    /**
     * @Assert\Range(
     *      min = 10,
     *      max = 400
     * )
     * @var int|null
     */
    private $minSurface;

    /**
     *
     * @var ArrayCollection
     */
    private $options;

    
    public function __construct() {
        $this->options = new ArrayCollection;
    }

    /**
     * @return integer|null
     */
    public function getMaxSurface(): ?int {
        return $this->maxSurface;
    }
    
    /**
     * @param integer|null $minSurface
     * @return PropertySearch
     */
    public function setMaxSurface(int $maxSurface): PropertySearch {
        $this->maxSurface = $maxSurface;
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getMinSurface(): ?int {
        return $this->minSurface;
    }
    
    /**
     * @param integer|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface): PropertySearch {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection {
        return $this->options;
    }

    /**
     *
     * @param ArrayCollection $options
     * @return void
     */
    public function setOptions(ArrayCollection $options): void {
        $this->options = $options;
    }


}