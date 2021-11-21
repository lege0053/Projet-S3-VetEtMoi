<?php declare(strict_types=1);

class Animal
{
    private string $animalId;
    private string $name;
    private string $birthDay;
    private ? string $deathDay;
    private ? string $comment;
    private string $userId;
    private int $threatId;
    private int $genderId;
    private int $raceId;

    /**
     * Return Animal object from an id.
     * @param int $id
     * @return static
     * @throws Exception
     */
    public static function createFromId(string $id):self
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Animal
        WHERE animalId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $req->execute([$id]);
        $return=$req->fetch();
        if(!$return)
        {
            throw new InvalidArgumentException("Id not not in DataBase.");
        }
        return $return;
    }

    /**
     * Return all animal by birthDate (or columnName).
     * @param string|null $columnName
     * @return array
     * @throws Exception
     */
    public static function getAllPet(string $columnName=null):array
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Animal
        ORDER birthDay
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $req->execute();
        $return=$req->fetchAll();
        if(!$return)
            throw new Exception("No Pet in DataBase.");
        if($columnName!=null)
        {
            try {
                $columnOfSort = array_column($return, $columnName);
                array_multisort($columnOfSort, SORT_ASC, $return);
            }catch (Exception $e)
            {
                echo("$columnName : invalid column name ! ");
            }
        }
        return $return;
    }

    /**
     * Return all animal with the specified genderStatusId.
     * @param int $id
     * @return array
     * @throws Exception
     */
    public static function getPetByGenderStatus(int $id)
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Animal
        WHERE genderId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $req->execute([$id]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("No animal with this genderStatusId.");
        }
        return $return;
    }

    /**
     * Return all animal with the specific threatId.
     * @param int $id
     * @return array
     * @throws Exception
     */
    public static function getPetBythreat(int $id)
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Animal
        WHERE threatId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $req->execute([$id]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("No animal with this threatId.");
        }
        return $return;
    }

    /**
     * Return all animal of the specified raceId.
     * @param int $id
     * @return array
     * @throws Exception
     */
    public static function getPetByRace(int $id)
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Animal
        WHERE raceId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $req->execute([$id]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("No animal of this raceId.");
        }
        return $return;
    }

    /**
     * Return all animal of the specified speciesId
     * @param int $id
     * @return array
     * @throws Exception
     */
    public static function getPetBySpecies(int $id)
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Animal
        WHERE raceId IN(SELECT raceId
                        FROM Race
                        WHERE especeId=?)
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $req->execute([$id]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("No animal of this species.");
        }
        return $return;
    }

    /**
     * Return all the meeting of the animal.
     * @return array
     * @throws Exception
     */
    public function getAllMeetings()
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Meeting
        WHERE animalId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Meeting::class);
        $req->execute([$this->animalId]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("No meeting for this animal.");
        }
        return $return;
    }

    /**
     * @return int
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getRaceId(): int
    {
        return $this->raceId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDeathDay(): string
    {
        return $this->deathDay;
    }

    /**
     * @return string
     */
    public function getBirthDay(): string
    {
        return $this->birthDay;
    }

    /**
     * @return int
     */
    public function getAnimalId(): string
    {
        return $this->animalId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return int
     */
    public function getGenderId(): int
    {
        return $this->genderId;
    }

    /**
     * @return int
     */
    public function getThreatId(): int
    {
        return $this->threatId;
    }

    /**
     * @param int $genderId
     */
    public function setGenderId(int $genderId): void
    {
        $this->genderId = $genderId;
    }

    /**
     * @return string
     */
    public function getNameRace(): string {
        $race = Race::createFromId($this->getRaceID());
        return $race->getRaceName();
    }

    /**
     * @return string
     */
    public function getSpecieName(): string {
        $race = Race::createFromId($this->getRaceID());
        $specie = Species::createFromId($race->getSpeciesId());
        return $specie->getSpeciesName();
    }

    public function getGenderName(): string
    {
        if($this->genderId == 1)
        {
            return "Femelle";
        }
        return "Mâle";
    }

}