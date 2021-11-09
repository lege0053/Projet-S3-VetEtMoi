<?php
declare(strict_types=1);

class RaceBd
{
    private int $raceId;
    private string $raceName;
    private int $speciesId;

    public static function createFromId(int $id):self
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Race
        WHERE raceId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, RaceBd::class);
        $req->execute([$id]);
        $return=$req->fetch();
        if(!$return)
        {
            throw new InvalidArgumentException("Id not not in DataBase.");
        }
        return $return;
    }

    /**
     * Retourne le nom de la race.
     * @return string
     */
    public function getRaceName() {
        return $this->raceName;
    }

    /**
     * Retourne l'id de l'espèce de la race.
     * @return int
     */
    public function getSpeciesId() {
        return $this->speciesId;
    }

    public function addNewRace(string $raceName, string $speciesId) {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Race
        WHERE raceName=? AND speciesId = ?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Race::class);
        $req->execute([$raceName, $speciesId]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("This race already exist.");
        }

        $insert=MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO RACE ('raceId', 'raceName', 'speciedId')
        VALUES (?, ?, ?)
        SQL);
        $insert->setFetchMode(PDO::FETCH_CLASS, Race::class);
        $insert->execute([$raceId, $raceName, $speciesId]);
        $return=$insert->fetchAll();

    }
}