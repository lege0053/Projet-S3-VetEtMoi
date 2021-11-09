<?php
declare(strict_types=1);

class Meeting
{

    private int $meetingId;
    private string $meetingDate;
    private int $isPayed;
    private double $price;
    private string $userId;
    private string $animalId;

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
    public function getMeetingId(): int
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

}