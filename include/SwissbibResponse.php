<?php
/**
 * Created by PhpStorm.
 * User: swissbib
 * Date: 2/26/15
 * Time: 3:33 PM
 */

class SwissbibResponse {

    private $sruValueObjects = array();
    private $hits;


    public function addValueObject($object)
    {
        $this->sruValueObjects[] = $object;
    }


    public function getValueObjects()
    {
        return $this->sruValueObjects;
    }

    /**
     * @return mixed
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param mixed $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }




}