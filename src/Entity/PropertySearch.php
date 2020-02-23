<?php

namespace App\Entity;

class PropertySearch {

    /**
     *
     * @var int|null
     */
    private $maxSurface;

    /**
     *
     * @var int|null
     */
    private $minSurface;

    
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





}