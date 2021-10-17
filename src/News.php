<?php declare(strict_types=1);

class News
{
    private int $newsId;
    private string $title;
    private string $content;
    private string $dateNews;
    private string $userId;

    /**
     * Create News object from an id.
     * @param int $id
     * @return static
     * @throws Exception
     */
    public static function createFromId(int $id):self
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM News
        WHERE newsId=?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, News::class);
        $req->execute([$id]);
        $return=$req->fetch();
        if(!$return)
        {
            throw new InvalidArgumentException("Id not in DataBase.");
        }
        return $return;
    }

    /**
     * Return all News by dateNews (or columnName).
     * @param string|null $columnName
     * @return array
     * @throws Exception
     */
    public static function getAllNews(string $columnName=null):array
    {
        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM News
        ORDER by dateNews
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, News::class);
        $req->execute();
        $return=$req->fetchAll();
        if(!$return)
            throw new Exception("No news in DataBase");
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
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getDateNews(): string
    {
        return $this->dateNews;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getNewsId(): int
    {
        return $this->newsId;
    }
}