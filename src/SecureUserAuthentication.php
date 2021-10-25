<?php
declare(strict_types=1);
include "Random.php";
include "AbstractUserAuthentication.php";
include "AuthenticationException.php";

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

        $mailSVG = WebPage::getIcon("mail");
        $mdpSVF = WebPage::getIcon("lock");
        $submitButton = WebPage::getHTMLButton(true, "Se Connecter");

        return <<<HTML
        <script type="text/javascript" src="js/sha512v2.js"></script>
        <script type="text/javascript">
            function codeSHA512() {
                let hashEmail = Sha512.hash(document.getElementById('email').value.toString());
                console.log(hashEmail);
                let hashPassword = Sha512.hash(document.getElementById('password').value.toString());
                console.log(hashPassword);
                let challenge = document.getElementById('challenge').value.toString();
                console.log(challenge)
                document.getElementById('code').value = Sha512.hash(hashPassword + challenge + hashEmail);
                console.log(document.getElementById('code').value);
            } 
        </script>
        <div class="d-flex flex-row justify-content-center">
            <img src="img/animal/cat1.png" height="250px" class="align-self-center"/>
            <div class="d-flex flex-column w-50 pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
                <form action="$action" method="post" onsubmit="codeSHA512();">   
                    <div class="d-flex pb-4 mt-2 justify-content-center">
                        <h2 style="font-weight: bold;">Connexion</h2>
                    </div>                 
                    <div class="form-group d-flex flex-column">
                        <div class="d-flex flex-row">
                            $mailSVG
                            <div style="font-weight: bold;">Adresse Mail</div>
                        </div>
                        <input type="email" id="email" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre Adresse Mail" required>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <div style="font-weight: bold;" class="d-flex flex-row">
                            $mdpSVF
                            <div>Mot de passe</div>
                        </div>
                        <input type="password" id="password" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre mot de passe" required>
                        <a href="#" style="color: #02897A; font-weight: bold;">Mot de passe oublié ?</a>
                    </div>
                    <input type="text" id="challenge" value="{$_SESSION[self::SESSION_CHALLENGE_KEY]}" hidden>
                    <input type="text" id="$code" name="$code" hidden>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="form-group d-inline-flex mt-3">
                            $submitButton
                        </div>
                    </div>
                </form>
            </div>
        </div>
        HTML;

    }

    public function getUserFromAuth(): User
    {
        Session::start();
        $challenge = $_SESSION[self::SESSION_CHALLENGE_KEY];
        $pdo = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Users
            WHERE SHA2(CONCAT(password, :challenge, SHA2(email, 512)), 512) = :code
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