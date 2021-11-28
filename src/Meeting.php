<?php
declare(strict_types=1);
include_once("Animal.php");
include_once("TimeSlot.php");

class Meeting
{

    private string $meetingId;
    private string $meetingDate;
    private int $isPayed;
    private ? float $price;
    private string $userId;
    private string $animalId;
    private string $vetoId;

    /**
     * @param int $meetingId
     * @return $this
     */
    public static function createFromId(string $meetingId): self {
        $pdo = MyPDO::getInstance()->prepare(<<< SQL
            SELECT * FROM Meeting
            WHERE meetingId = :meetingId
        SQL);
        $pdo->execute(['meetingId' => $meetingId]);
        $pdo->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $pdo->fetch();
    }

    /**
     * @return string
     */
    public function getAnimalId(): string
    {
        return $this->animalId;
    }

    /**
     * @return bool
     */
    public function isPayed(): bool
    {
        return $this->isPayed == 1;
    }

    /**
     * @return string
     */
    public function getMeetingDate(): string
    {
        return $this->meetingDate;
    }

    /**
     * @return int
     */
    public function getMeetingId(): string
    {
        return $this->meetingId;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getAnimal() : Animal
    {
        return Animal::createFromId($this->animalId);
    }

    /**
     * @return string
     */
    public function getVetoId(): string
    {
        return $this->vetoId;
    }

    public function getVetoName():string
    {
        $veto = new User(['userId'=>$this->vetoId, 'isVeto'=>1, 'isAdmin'=>1]);
        $veto->flush();
        return "{$veto->getLastName()} {$veto->getFirstName()}";
    }

    public function getTimeSlots() : array
    {
        $rq = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM TimeSlot
            WHERE timeSlotId IN (SELECT timeSlotId FROM Concern
                                WHERE meetingId = :meetingId);
        SQL);
        $rq->execute(['meetingId' => $this->meetingId]);
        $rq->setFetchMode(PDO::FETCH_CLASS, TimeSlot::class);
        $array = $rq->fetchAll();
        if($array)
            return $array;
        throw new Exception("No Meeting with id {$this->meetingId} in Concern.");
    }

    public function getDateTime() : string
    {
        try{
            $timeSlots = $this->getTimeSlots();
            return $this->meetingDate.' '.$timeSlots[0]->getStartHour();
        } catch(Exception $e){
            return $this->meetingDate;
        }
    }

}