<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

if ((!isset($_GET["id"])) || !ctype_digit($_GET["id"])) {
    header("Location: listeAnimal.php");
}
$animalId = $_GET['id'];

$webPage = new WebPage("Rendez-vous");

$stmt = MyPDO::getInstance()->prepare(
    <<<SQL
SELECT Animal.name as "name", DATE_FORMAT(Animal.birthDay, "%d/%c/%Y") as "birthDay", DATE_FORMAT(Meeting.meetingDate, "%a %e %b %Y") as "RDV"
FROM Animal JOIN Meeting ON (Animal.animalId=Meeting.animalId)
WHERE Animal.animalId = ?
AND max(Meeting.meetingDate < SYSDATE)
OR min(Meeting.meetingDate > SYSDATE)
ORDER BY 3;
SQL
);
$stmt->execute([$animalId]);
$rep = $stmt->fetchAll();

$a = 0;
if ($rep){
    foreach ($rep as $reponse) {
        $name = $reponse['name'];
        $birthDay = $reponse["birthDay"];
        if($a == 0){
            $dernierRDV = $reponse["RDV"];
        } else {
            $futurRDV = $reponse["RDV"];
        }
        $a += 1;
    }
}


$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">{$webPage->getIcon('cat')}Le profil de {$name}}</h3>
</div>

<div class="d-flex flex-row pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
    <img src="img/partChien.png" class="mx-auto w-25" alt="">
    <div class="d-flex flex-column justify-content-left">
        <div class="d-flex flex-column justify-content-left"> 
            <a style="color: #02897A; font-weight: bold;">Nom
            <a style="color: #262626; font-weight: bold;">{$name}
        </div>
        <div class="d-flex flex-column justify-content-left">
            <a style="color: #02897A; font-weight: bold;">Age
            <a style="color: #262626; font-weight: bold;">1 an 2 mois
        </div>
        <div class="d-flex flex-column justify-content-left">
            <a style="color: #02897A; font-weight: bold;">Date de Naissance
            <a style="color: #262626; font-weight: bold;">{$birthDay}
        </div>
    </div>
    <div class="d-flex flex-column justify-content-left">
        <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
        <a style="color: #262626; font-weight: bold;">{$futurRDV}
        <a style="color: #262626; font-weight: bold;">11:00
        <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
        <a style="color: #262626; font-weight: bold;">{$dernierRDV}
    </div>
</div>

<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;"><svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.1997 11.9011L11.3326 6.2542C11.3577 5.18406 12.0649 4.25011 13.0881 3.93563C16.4246 2.91013 19.9922 2.91013 23.3288 3.93563C24.352 4.25011 25.0591 5.18406 25.0843 6.2542L25.2171 11.9011C26.6059 13.1932 27.637 14.8646 28.1457 16.7503C28.2828 16.2459 28.744 15.875 29.2917 15.875C29.9476 15.875 30.4792 16.4067 30.4792 17.0625V21.8125C30.4792 22.4684 29.9476 23 29.2917 23C28.744 23 28.2828 22.6291 28.1457 22.1247C27.637 24.0105 26.6059 25.6818 25.2171 26.9739L25.0843 32.6209C25.0591 33.691 24.352 34.625 23.3288 34.9394C19.9922 35.9649 16.4246 35.9649 13.0881 34.9394C12.0649 34.625 11.3577 33.691 11.3326 32.6209L11.1997 26.9739C9.18008 25.0949 7.91675 22.4137 7.91675 19.4375C7.91675 16.4613 9.18008 13.7802 11.1997 11.9011ZM13.7858 6.20582C16.6677 5.32007 19.7492 5.32007 22.631 6.20582C22.677 6.21996 22.7088 6.26194 22.71 6.31005L22.802 10.2254C21.4193 9.53453 19.8592 9.14585 18.2084 9.14585C16.5576 9.14585 14.9976 9.53453 13.6148 10.2254L13.7069 6.31005C13.708 6.26194 13.7398 6.21996 13.7858 6.20582ZM13.6148 28.6497L13.7069 32.565C13.708 32.6131 13.7398 32.6551 13.7858 32.6692C16.6677 33.555 19.7492 33.555 22.631 32.6692C22.677 32.6551 22.7088 32.6131 22.71 32.565L22.8021 28.6497C21.4193 29.3405 19.8592 29.7292 18.2084 29.7292C16.5576 29.7292 14.9976 29.3405 13.6148 28.6497ZM14.5697 23.0762C14.106 22.6124 13.3541 22.6124 12.8904 23.0762C12.4266 23.5399 12.4266 24.2918 12.8904 24.7556C15.8274 27.6926 20.5894 27.6926 23.5264 24.7556C23.9902 24.2918 23.9902 23.5399 23.5264 23.0762C23.0627 22.6124 22.3108 22.6124 21.847 23.0762C19.8375 25.0857 16.5793 25.0857 14.5697 23.0762Z" fill="#373737"/></svg>
Poser un Rendez-Vous</h3>
</div>
HTML;

//Tableau de RDV

$webPage->appendContent($html);
echo $webPage->toHTML();