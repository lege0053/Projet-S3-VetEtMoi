<?php
declare(strict_types=1);
include "MyPDO.php";
include "User.php";
include "Session.php";
include "NotLoggedInException.php";

abstract class AbstractUserAuthentication
{
    const LOGOUT_INPUT_NAME = 'logout';
    const SESSION_KEY = '__UserAuthentication__';
    const SESSION_USER_KEY = 'user';
    private ?User $user = null;

    public function __construct(){
        try{
            $this->user = $this->getUserFromSession();
        }catch(NotLoggedInException $e){
            $e->getTraceAsString();
        }
    }

    public abstract function loginForm(string $action, string $submitText = 'OK'): string;

    public function logoutForm(string $action, string $text): string
    {
        $logout = self::LOGOUT_INPUT_NAME;
        return <<<HTML
        <form action="$action" method="post">
            <input type="submit" name="$logout" value="$text">
        </form>
        HTML;
    }

    public abstract function getUserFromAuth() : User;

    public function logoutIfRequested() : void {
        Session::start();
        if(isset($_POST[self::LOGOUT_INPUT_NAME])){
            unset($_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY]);
            $this->user = null;
        }
    }

    public static function isUserConnected(): bool {
        Session::start();
        return isset($_SESSION[self::SESSION_KEY]) && isset($_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY]) && $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY] instanceof User;
    }

    public static function isUserAdmin() : bool {
        Session::start();
        return isset($_SESSION[self::SESSION_KEY]) && isset($_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY]) && $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY] instanceof User && $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY]->isAdmin();
    }

    public static function isUserVeto() : bool {
        Session::start();
        return isset($_SESSION[self::SESSION_KEY]) && isset($_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY]) && $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY] instanceof User && $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY]->isVeto();
    }

    protected function getUserFromSession() : User {
        Session::start();
        if(!$this->isUserConnected())
            throw new NotLoggedInException('Utilisateur non connecté');
        return $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY];
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        if(!isset($this->user))
            throw new NotLoggedInException('Utilisateur non connecté');
        return $this->user;
    }

    protected function setUser(User $user): void {
        Session::start();
        $this->user = $user;
        $_SESSION[self::SESSION_KEY][self::SESSION_USER_KEY] = $user;
    }
}