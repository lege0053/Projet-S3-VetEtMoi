<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Prise de Rendez-Vous");
$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

if(isset($_POST['animal'])){
    $animalId=$_POST['animal'];
    $nom=Animal::createFromId($animalId)->getName();
    $h3="Prendre Rendez-Vous pour $nom";
    $conditionalSelect="";
}
else
{
    $h3="Prendre Rendez-Vous pour votre nouvel animal : ";
    $conditionalSelect="<select name='species' required>";
    $reqSpecies=MyPDO::getInstance()->prepare(<<<SQL
    SELECT speciesId, speciesName
    FROM Species
SQL);
    $reqSpecies=$reqSpecies->fetchAll();
    $optionSpecies="";
    foreach($reqSpecies as $species)
    {
        $optionSpecies.="<option value='{$species['speciesId']}'>{$species['speciesName']}</option>";
    }
    $conditionalSelect.="</select>";
}


$reqVeto=MyPDO::getInstance()->prepare(<<<SQL
SELECT lastName, firstName, userId
FROM Users
WHERE isVeto=1
SQL);
$reqVeto=$reqVeto->fetchAll();
$optionsVeto="";
foreach($reqVeto as $veto)
{
    $optionsVeto.="<option value='{$veto['userId']}'>{$veto['lastName']}{$veto['lastName']}</option>";
}

$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;"></h3>
</div>
<div>
    <form action="./trmt/prisederdv_trmt.php" method="post">
        <select name="veto" required>$optionsVeto</select>
        $conditionalSelect
        <!--AjouterTableau-->
    <button type="submit"></button>
    </form>
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();