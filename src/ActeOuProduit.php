<?php
declare(strict_types=1);

class ActeOuProduit
{
    private int $id;
    private string $name;
    private float $PU_TTC;

    public function __construct(int $id, string $name, float $PU_TTC)
    {
        $this->id = $id;
        $this->name = $name;
        $this->PU_TTC = $PU_TTC;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPUTTC(): float
    {
        return $this->PU_TTC;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param float $PU_TTC
     */
    public function setPUTTC(float $PU_TTC): void
    {
        $this->PU_TTC = $PU_TTC;
    }

}