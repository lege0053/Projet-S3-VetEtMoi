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
    $reqSpecies->execute();
    $reqSpecies=$reqSpecies->fetchAll();
    foreach($reqSpecies as $species)
    {
        $conditionalSelect.="<option value='{$species['speciesId']}'>{$species['speciesName']}</option>";
    }
    $conditionalSelect.="</select>";
}


$reqVeto=MyPDO::getInstance()->prepare(<<<SQL
SELECT lastName, firstName, userId
FROM Users
WHERE isVeto=1
SQL);
$reqVeto->execute();
$reqVeto=$reqVeto->fetchAll();
$optionsVeto="";
foreach($reqVeto as $veto)
{
    $optionsVeto.="<option value='{$veto['userId']}'>{$veto['lastName']}{$veto['lastName']}</option>";
}

$submitButton=$webPage->getHTMLButton(true, 'Valider');

$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">$h3</h3>
</div>
<div>
    <form action="./trmt/prisederdv_trmt.php" method="post">
        <select name="veto" id="veto" required>$optionsVeto</select>
        $conditionalSelect
        <!--AjouterTableau-->
        $submitButton
    </form>
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();