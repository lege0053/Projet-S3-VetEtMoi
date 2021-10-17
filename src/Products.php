<?php declare(strict_types=1);

class Products
{
    private int $productId;
    private string $productName;
    private int $quantity;
    private int $quantityLimit;

    /**
     * Create product object from an id.
     * @param int $id
     * @return static
     * @throws Exception
     */
    public static function createFromId(int $id):self
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Products
        WHERE productId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Products::class);
        $req->execute([$id]);
        $return=$req->fetch();
        if(!$return)
        {
            throw new InvalidArgumentException("Id not in DataBase");
        }
        return $return;
    }

    /**
     * Return all product (order by name, or columnName)
     * @param string|null $columnName
     * @return array
     * @throws Exception
     */
    public static function getAllProducts(string $columnName=null):array
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Products
        ORDER by productName
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Products::class);
        $req->execute();
        $return=$req->fetchAll();
        if(!$return)
            throw new Exception("No products in DataBase");
        if($columnName!=null)
        {
            try {
                $columnOfSort = array_column($return, $columnName);
                array_multisort($columnOfSort, SORT_ASC, $return);
            }catch (Exception $e)
            {
                echo("$columnName  : invalid column name !");
            }
        }
        return $return;
    }

    /**
     * Increment or decrement quantity, return if the product should be command.
     * @param int $value
     * @return bool
     * @throws Exception
     */
    public function changeQuantity(int $value):bool
    {
        $warning=false;
        $req=MyPDO::getInstance()->prepare(<<<SQL
        UPDATE Products
        SET quantity=quantity + ?
        WHERE productId = ?
        SQL);

        $req->execute([$value, $this->productId]);
        if($this->quantity+$value<$this->quantityLimit)
        {
            $warning=true;
        }
        return $warning;
    }

    /**
     * Return all commands related to the product.
     * @return array
     * @throws Exception
     */
    public function getRelatedCommand():array
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Command
        WHERE commandId IN(SELECT commandId
                            FROM Content
                            WHERE productId=?)
        ORDER BY dateCmd
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Commande::class);
        $req->execute([$this->productId]);
        $return=$req->fetchAll();
        if(!$return)
        {
            throw new InvalidArgumentException("No command related to the product.");
        }
        return $return;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getQuantityLimit(): int
    {
        return $this->quantityLimit;
    }
}