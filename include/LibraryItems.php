<?php
/**
 * Created by PhpStorm.
 * User: swissbib
 * Date: 2/26/15
 * Time: 5:49 PM
 */

class LibraryItems {

    protected $localSystemNumber;
    protected $backlink;
    protected $libraryName;
    protected $displayName;
    protected $holdingsField;
    protected $callNumber;
    protected $itemNetwork;

    /**
     * @return mixed
     */
    public function getLocalSystemNumber()
    {
        return $this->localSystemNumber;
    }

    /**
     * @param mixed $localSystemNumber
     */
    public function setLocalSystemNumber($localSystemNumber)
    {
        $this->localSystemNumber = $localSystemNumber;
    }

    /**
     * @return mixed
     */
    public function getBacklink()
    {
        return $this->backlink;
    }

    /**
     * @param mixed $backlink
     */
    public function setBacklink($backlink)
    {
        $this->backlink = $backlink;
    }

    /**
     * @return mixed
     */
    public function getLibraryName()
    {
        return $this->libraryName;
    }

    /**
     * @param mixed $libraryName
     */
    public function setLibraryName($libraryName)
    {
        $this->libraryName = $libraryName;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getHoldingsField()
    {
        return $this->holdingsField;
    }

    /**
     * @param mixed $holdingsField
     */
    public function setHoldingsField($holdingsField)
    {
        $this->holdingsField = $holdingsField;
    }

    /**
     * @return mixed
     */
    public function getCallNumber()
    {
        return $this->callNumber;
    }

    /**
     * @param mixed $callNumber
     */
    public function setCallNumber($callNumber)
    {
        $this->callNumber = $callNumber;
    }

    /**
     * @return mixed
     */
    public function getItemNetwork()
    {
        return $this->itemNetwork;
    }

    /**
     * @param mixed $itemNetwork
     */
    public function setItemNetwork($itemNetwork)
    {
        $this->itemNetwork = $itemNetwork;
    }






}