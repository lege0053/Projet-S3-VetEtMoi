<?php
declare(strict_types=1);

class User
{
    private int $userId;
    private string $cp;
    private string $ville;
    private string $rue;
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private int $isAdmin;
    private string $commentaire;

    public function __construct(array $data)
    {
        $this->userId = (int)$data['id'] ?? -1;
        $this->cp = $data['cp'] ?? '';
        $this->ville = $data['ville'] ?? '';
        $this->rue = $data['rue'] ?? '';
        $this->lastName = $data['lastName'] ?? '';
        $this->firstName = $data['firstName'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->isAdmin = $data['isAdmin'] ?? '';
        $this->commentaire = $data['commentaire'] ?? '';
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return int
     */
    public function getUserId(): int
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
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * @return mixed|string
     */
    public function getVille(): string
    {
        return $this->ville;
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
     * @return string
     */
    public function profile() : string
    {
        return <<<HTML
            <span>Nom<br>&emsp;{$this->lastName}</span><br>
            <span>Prénom<br>&emsp;{$this->firstName}</span><br>
            <span>Téléphone<br>&emsp;{$this->phone}</span>
HTML;
    }

}