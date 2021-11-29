<?php
declare(strict_types=1);
require_once ("WebPage.php");
include_once "MyPDO.php";
include_once "Animal.php";

class User
{

    private string $userId;
    private string $cp;
    private string $city;
    private string $rue;
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private int $isAdmin;
    private int $isVeto;
    private string $comment;

    public function __construct(array $data)
    {
        $this->userId = $data['userId'] ?? '';
        $this->cp = $data['cp'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->rue = $data['rue'] ?? '';
        $this->lastName = $data['lastName'] ?? '';
        $this->firstName = $data['firstName'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->isAdmin = (int)($data['isAdmin']) ?? 0;
        $this->isVeto = (int)($data['isVeto']) ?? 0;
        $this->comment = $data['comment'] ?? '';
    }

    public function flush()
    {
        $req = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Users
            WHERE userId = :userId;
        SQL
        );
        $req->execute(['userId' => $this->userId]);
        $data = $req->fetch();
        $this->cp = $data['cp'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->rue = $data['rue'] ?? '';
        $this->lastName = $data['lastName'] ?? '';
        $this->firstName = $data['firstName'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->comment = $data['comment'] ?? '';
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
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
    public function getLastName(): string
    {
        return $this->lastName;
    }


    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return mixed|string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return mixed|string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return mixed|string
     */
    public function getRue(): string
    {
        return $this->rue;
    }

    /**
     * @return int|mixed|string
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin == 1;
    }

    /**
     * @return bool
     */
    public function isVeto(): bool
    {
        return $this->isVeto == 1;
    }

    /**
     * @return mixed|string
     */
    public function getCp(): string
    {
        return $this->cp;
    }

    /**
     * @return mixed|string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getAnimals(): array
    {
        $pdo = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Animal
            WHERE userId = :userId;
        SQL);
        $pdo->execute(['userId' => $this->userId]);
        $pdo->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        $array = $pdo->fetchAll();
        if(!$array)
        {
            throw new InvalidArgumentException("No animals for this user.");
        }
        return $array;
    }

    public function getMeetings() : array
    {
        $pdo = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Meeting
            WHERE userId = :userId AND meetingDate > CAST(CURRENT_TIMESTAMP AS DATE)
            AND animalId IS NOT NULL
            ORDER by meetingDate;
        SQL);
        $pdo->execute(['userId' => $this->userId]);
        $pdo->setFetchMode(PDO::FETCH_CLASS, Meeting::class);
        return $pdo->fetchAll();
    }

    /**
     * @return string
     */
    public function getHTMLProfile(): string
    {
        $webPage = new WebPage();
        return <<<HTML

            <div class="main-ui-class">
                <span class="title" style="margin-bottom: 38px;">Mon Profil</span>
                <div class="d-flex" style="justify-content: space-evenly; margin-bottom: 38px; gap: 38px;">
                    {$webPage->getHTMLButton(false, "Mes Animaux", "listeAnimal.php", "15px", "15px", "19px")}
                    {$webPage->getHTMLButton(false, "Mes factures", "#", "15px", "15px", "19px")}
                    <form action="trmt/logout.php" method="post" style="display: flex; justify-content: center;">
                        <input name="logout" hidden>
                        {$webPage->getHTMLButton(true, "Se déconnecter", "#", "15px", "25px", "19px")}
                    </form> 
                </div>
                
                <div class="w-100" style="display: flex; flex-direction: column; gap: 20px;">
                    <div class="d-flex w-100" style="gap: 20px;">
                        <div class="d-flex flex-grow-1 flex-column">
                            <span class="d-flex">
                                {$webPage->getIcon("user")}
                                <span>Nom</span>
                            </span>
                            <span class="info-container">{$this->lastName}</span>
                        </div>
                        
                        <div class="d-flex flex-grow-1 flex-column">
                            <span class="d-flex">
                                {$webPage->getIcon("user")}
                                <span>Prénom</span>
                            </span>
                            <span class="info-container">{$this->firstName}</span>
                        </div>
                    </div>
                    
                    <div class="d-flex w-100 flex-column">
                        <span class="d-flex">
                            {$webPage->getIcon("phone")}
                            <span>Téléphone</span>
                        </span>
                        <div class="d-flex w-100" style="gap: 20px;">
                            <span class="info-container flex-grow-1">{$this->phone}</span>
                            {$webPage->getHTMLButton(false, "Modifier", "profile_change_phone.php", "15px", "25px", "18px")}
                        </div>
                    </div>
                    
                    <div class="d-flex w-100 flex-column">
                        <span class="d-flex">
                            {$webPage->getIcon("house")}
                                <span>Adresse Postale</span>
                        </span>
                        <div class="d-flex w-100" style="gap: 20px;">
                            <span class="info-container flex-grow-1">{$this->rue} {$this->cp} {$this->city}</span>
                            {$webPage->getHTMLButton(false, "Modifier", "profile_change_adresse.php", "15px", "25px", "18px")}
                        </div>
                    </div>
                    
                    <div class="d-flex w-100 flex-column">
                        <span class="d-flex">
                            {$webPage->getIcon("mail")}
                            <span>Adresse Mail</span>
                        </span>
                        <div class="d-flex w-100" style="gap: 20px;">
                            <span class="info-container flex-grow-1">{$this->email}</span>
                            {$webPage->getHTMLButton(false, "Modifier", "profile_change_mail.php", "15px", "25px", "18px")}
                        </div>
                    </div>
                    
                    <div class="d-flex w-100 flex-column">
                        <span class="d-flex">
                            {$webPage->getIcon("lock")}
                            <span>Mot de Passe</span>
                        </span>
                        <div class="d-flex w-100" style="gap: 20px;">
                            <span class="info-container flex-grow-1">**************</span>
                            {$webPage->getHTMLButton(false, "Modifier", "profile_change_password.php", "15px", "25px", "18px")}
                        </div>
                    </div>
                </div>
            </div>
HTML;
    }
}