<?php
declare(strict_types=1);

include_once "MyPDO.php";

class TimeSlot
{
    private int $timeSlotId;
    private string $startHour;
    private string $endHour;
    private string $dayName;
    private int $typeId;

    public static function createFromId(int $timeSlotId) : self
    {
        $rq = MyPDO::getInstance()->prepare(<<< SQL
            SELECT * FROM TimeSlot
            WHERE timeSlotId = :timeSlotId;
        SQL);
        $rq->execute(['timeSlotId' => $timeSlotId]);
        $rq->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $rq->fetch();
    }

    /**
     * @return string
     */
    public function getDayName(): string
    {
        return $this->dayName;
    }

    /**
     * @return string
     */
    public function getEndHour(): string
    {
        return $this->endHour;
    }

    /**
     * @return string
     */
    public function getStartHour(): string
    {
        return $this->startHour;
    }

    /**
     * @return int
     */
    public function getTimeSlotId(): int
    {
        return $this->timeSlotId;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

}