<?php
declare(strict_types=1);

class Command
{
    private int $commandId;
    private float $commandPrice;
    private string $commandDate;

    /**
     * Create command object from an id.
     * @param int $id
     * @return static
     * @throws Exception
     */
    public static function createFromId(int $id):self
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Command
        WHERE commandId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Command::class);
        $req->execute([$id]);
        $return=$req->fetch();
        if(!$return)
        {
            throw new InvalidArgumentException("Id not in Database.");
        }
        return $return;
    }

    /**
     * Return all command (order by commandDate, or columnName).
     * @param string|null $columnName
     * @return array
     * @throws Exception
     */
    public static function getAllCommands(string $columnName=null):array
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Command
        ORDER by commandDate
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Command::class);
        $req->execute();
        $return=$req->fetchAll();
        if(!$return)
            throw new Exception("No command in DataBase.");
        if($columnName!=null)
        {
            try {
                $columnOfSort = array_column($return, $columnName);
                array_multisort($columnOfSort, SORT_ASC, $return);
            }catch (Exception $e)
            {
                echo("$columnName : invalid column name !");
            }
        }
        return $return;
    }

    /**
     * Return all product of this command.
     * @return array
     * @throws Exception
     */
    public function getRelatedProduct():array
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Produit
        WHERE idProduit IN(SELECT idProduit
                           FROM ContenirProduit
                           WHERE commandId=?)
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Products::class);
        $req->execute([$this->commandId]);
        $return=$req->fetch();
        if(!$return)
        {
            throw new InvalidArgumentException("No products in this command.");
        }
        return $return;
    }

    /**
     * @return string
     */
    public function getCommandDate(): string
    {
        return $this->commandDate;
    }

    /**
     * @return int
     */
    public function getCommandId(): int
    {
        return $this->commandId;
    }

    /**
     * @return float
     */
    public function getCommandPrice(): float
    {
        return $this->commandPrice;
    }
}