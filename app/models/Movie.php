<?php


class Movie
{
    private $id;
    private $name;
    private $rank;
    private $description;
    private $year;
    private $picture;
    private $iframe;
    private $categoryId;


    public function __construct($id, $name, $rank, $description, $year, $picture, $iframe,$categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->rank = $rank;
        $this->description = $description;
        $this->year = $year;
        $this->picture = $picture;
        $this->iframe = $iframe;
        $this->categoryId = $categoryId;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function setRank($rank): void
    {
        $this->rank = $rank;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year): void
    {
        $this->year = $year;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }

    public function getIframe()
    {
        return $this->iframe;
    }

    public function setIframe($iframe): void
    {
        $this->iframe = $iframe;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

}