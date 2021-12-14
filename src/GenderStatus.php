<?php
declare(strict_types=1);

class GenderStatus
{
    private $genderId;
    private $genderName;

    /**
     * @return mixed
     */
    public function getGenderId()
    {
        return $this->genderId;
    }

    /**
     * @return mixed
     */
    public function getGenderName()
    {
        return $this->genderName;
    }

    public function getGenderStatusList():array
    {
        $rq = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM GenderStatus
        SQL);
        $rq->execute();
        $rq->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $rq->fetchAll();
    }

}