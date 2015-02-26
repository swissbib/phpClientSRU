<?php
/**
 * Created by PhpStorm.
 * User: swissbib
 * Date: 2/25/15
 * Time: 6:14 PM
 */

class SRUValueObject {


    protected $title;
    protected $author;
    protected $publicationDate;
    protected $publicationPlace;
    protected $publisher;
    protected $edition;

    protected $items = array();

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = (string)$title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = (string)$author;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = (string)$publicationDate;
    }

    /**
     * @return mixed
     */
    public function getPublicationPlace()
    {
        return $this->publicationPlace;
    }

    /**
     * @param mixed $publicationPlace
     */
    public function setPublicationPlace($publicationPlace)
    {
        $this->publicationPlace = (string)$publicationPlace;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = (string)$publisher;
    }

    /**
     * @return mixed
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param mixed $edition
     */
    public function setEdition($edition)
    {
        $this->edition = (string)$edition;
    }


    public function getItems()
    {
        return $this->items;
    }

    public function addItem($item) {
        $this->items[] = $item;
    }









}