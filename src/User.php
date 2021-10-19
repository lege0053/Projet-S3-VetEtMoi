<?php
declare(strict_types=1);

class User
{
    private int $userId;
    private string $cp;
    private string $city;
    private string $rue;
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private int $isAdmin;
    private string $comment;

    public function __construct(array $data)
    {
        $this->userId = (int)$data['userId'] ?? -1;
        $this->cp = $data['cp'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->rue = $data['rue'] ?? '';
        $this->lastName = $data['lastName'] ?? '';
        $this->firstName = $data['firstName'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->isAdmin = (int)($data['isAdmin']) ?? 0;
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
    public function isAdmin()
    {
        return $this->isAdmin == 1;
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