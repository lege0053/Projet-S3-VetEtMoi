<?php
declare(strict_types=1);

class Threat
{
    private $threatId;
    private $threatName;

    /**
     * @return mixed
     */
    public function getThreatId()
    {
        return $this->threatId;
    }

    /**
     * @return mixed
     */
    public function getThreatName()
    {
        return $this->threatName;
    }

    public function getThreatList():array
    {
        $rq = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Threat
        SQL);
        $rq->execute();
        $rq->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $rq->fetchAll();
    }

}