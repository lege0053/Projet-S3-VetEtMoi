<?php
declare(strict_types=1);
include "Random.php";

class SecureUserAuthentication extends AbstractUserAuthentication
{
    const CODE_INPUT_NAME = 'code';
    const SESSION_CHALLENGE_KEY = 'challenge';
    const RANDOM_STRING_SIZE = 16;

    public function loginForm(string $action, string $submitText = 'OK'): string
    {
        Session::start();
        $_SESSION[self::SESSION_CHALLENGE_KEY] = Random::string(self::RANDOM_STRING_SIZE);
        $code = self::CODE_INPUT_NAME;

        return <<<HTML
        <script type="text/javascript" src="js/sha512.js"></script>
        <script type="text/javascript">
            function codeSHA512() {
                var hashLogin = CryptoJS.SHA512(document.getElementById('login').value);
                var hashPassword = CryptoJS.SHA512(document.getElementById('password').value);
                var challenge = document.getElementById('challenge').value;
                document.getElementById('code').value = CryptoJS.SHA512(hashPassword + challenge + hashLogin);
            } 
        </script>
        <form action="$action" method="post" onsubmit="codeSHA512();">
            <input type="text" id="login" placeholder="login" required>
            <input type="password" id="password" placeholder="pass" required>
            <input type="text" id="challenge" value="{$_SESSION[self::SESSION_CHALLENGE_KEY]}" hidden>
            <input type="text" id="$code" name="$code" hidden>
            <input type="submit" value="$submitText">
        </form>
        HTML;

    }

    public function getUserFromAuth(): User
    {
        Session::start();
        $challenge = $_SESSION[self::SESSION_CHALLENGE_KEY];
        $pdo = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM user
            WHERE SHA2(CONCAT(sha512pass, :challenge, SHA2(login, 512)), 512) = :code
        SQL);
        $pdo->execute(['challenge' => $challenge, 'code' => $_POST['code']]);
        $array = $pdo->fetch();
        if (empty($array))
            throw new AuthenticationException('Liste d\'information vide');
        $user = new User($array);
        $this->setUser($user);
        return $user;
    }
}