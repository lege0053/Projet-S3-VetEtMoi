<?php
declare(strict_types=1);
require_once('../autoload.php');

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
   header("Location: connexion.php");

try {
    $auth->logoutIfRequested();
    header('Location: ../accueil.php');
} catch (Exception $e) {
    header("Location: ../profile.php");
}
