<?php
declare(strict_types=1);

class ActeOuProduit
{
    private int $id;
    private string $name;
    private float $PU_TTC;

    public function createFromId(int $id): self
    {
        $pdo = MyPDO::getInstance()->prepare(<<< SQL
            SELECT * FROM ActeOuProduit
            WHERE id = :id
        SQL
        );
        $pdo->execute(['id' => $id]);
        $pdo->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $pdo->fetch();
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
    public function getPU_TTC(): float
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