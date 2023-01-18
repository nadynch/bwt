<?php

class Conference
{
    private $table = "conferences";
    private $connection;
    private $id;
    private $title;
    private $date;
    private $country;
    private $addressX;
    private $addressY;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setAddressX($addressX): void
    {
        $this->addressX = $addressX;
    }

    public function setAddressY($addressY): void
    {
        $this->addressY = $addressY;
    }

    public function save()
    {
        if ($this->addressX == null || $this->addressY == null)
            return $this->saveWithoutAddress();
        $query = $this->connection->prepare("INSERT INTO " . $this->table .
            " SET ConferenceTitle = :title,
                ConferenceDate = :date,
                CountryID = :country,
                AddressX = :addressX,
                AddressY = :addressY");
        $result = $query->execute(array(
            "title" => $this->title,
            "date" => $this->date,
            "country" => $this->country,
            "addressX" => $this->addressX,
            "addressY" => $this->addressY
        ));
        $this->connection = null;
        return $result;
    }

    public function saveWithoutAddress()
    {
        $query = $this->connection->prepare("INSERT INTO " . $this->table .
            " SET ConferenceTitle = :title,
                  ConferenceDate = :date,
                  CountryID = :country");
        $result = $query->execute(array(
            "title" => $this->title,
            "date" => $this->date,
            "country" => $this->country
        ));
        $this->connection = null;
        return $result;
    }

    public function update()
    {
        $query = $this->connection->prepare("
            UPDATE " . $this->table . "
            SET
                ConferenceTitle = :title,
                ConferenceDate = :date,
                CountryID = :country,
                AddressX = :addressX,
                AddressY = :addressY
            WHERE ConferenceID = :id
        ");
        $result = $query->execute(array(
            "id" => $this->id,
            "title" => $this->title,
            "date" => $this->date,
            "country" => $this->country,
            "addressX" => $this->addressX,
            "addressY" => $this->addressY
        ));
        $this->connection = null;
        return $result;
    }

    public function getAll()
    {
        $query = $this->connection->prepare("SELECT ConferenceID,
                                                    ConferenceTitle,
                                                    DATE_FORMAT(ConferenceDate, '%M %d %Y') as ConferenceDate,
                                                    CountryName, 
                                                    AddressX, 
                                                    AddressY
                                                FROM " . $this->table . " 
                                                left join country on " . $this->table . ".CountryID = country.CountryID");
        $query->execute();
        $result = $query->fetchAll();
        $this->connection = null;
        return $result;
    }

    public function getById($id)
    {
        $query = $this->connection->prepare("SELECT ConferenceID,
                                                    ConferenceTitle,
                                                    ConferenceDate, 
                                                    CountryName, 
                                                    AddressX,
                                                    AddressY
                                                FROM " . $this->table . " 
                                                left join country on " . $this->table . ".CountryID = country.CountryID 
                                                WHERE ConferenceID = :id");
        $query->execute(array(
            "id" => $id
        ));
        $result = $query->fetchObject();
        $this->connection = null;
        return $result;
    }

    public function deleteById($id)
    {
        try {
            $query = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE ConferenceID = :id");
            $query->execute(array(
                "id" => $id
            ));
            $this->connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }
}