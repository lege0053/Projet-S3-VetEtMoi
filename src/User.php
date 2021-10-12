<?php
declare(strict_types=1);

class User
{
    private int $id;
    private string $lastName;
    private string $firstName;
    private string $login;
    private string $phone;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'] ?? -1;
        $this->lastName = $data['lastName'] ?? '';
        $this->firstName = $data['firstName'] ?? '';
        $this->login = $data['login'] ?? '';
        $this->phone = $data['phone'] ?? '';
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
    public function getId(): int
    {
        return $this->id;
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
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function profile() : string
    {
        return <<<HTML
            <span>Nom<br>&emsp;{$this->lastName}</span><br>
            <span>Prénom<br>&emsp;{$this->firstName}</span><br>
            <span>Login<br>&emsp;{$this->login}[{$this->id}]</span><br>
            <span>Téléphone<br>&emsp;{$this->phone}</span>
HTML;
    }

}