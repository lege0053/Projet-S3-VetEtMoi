<?php
declare(strict_types=1);

include "../src/SecureUserAuthentication.php";

if(isset($_POST[SecureUserAuthentication::CODE_INPUT_NAME]) && !empty($_POST[SecureUserAuthentication::CODE_INPUT_NAME])){
    $userAuth = new SecureUserAuthentication();
    try{
        $user = $userAuth->getUserFromAuth();
        header('Location: ../profile.php');
    } catch(AuthenticationException $e) {
        header('Location: ../connexion.php');
    }
} else
    header('Location: ../connexion.php');

