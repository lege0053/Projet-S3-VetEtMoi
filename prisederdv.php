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
    $conditionalSelect="<input type='hidden' name='animal' value=$animalId></input>";
}
else
{
    $h3="Prendre Rendez-Vous pour votre nouvel animal : ";
    $conditionalSelect=<<<HTML
<label for="species-select">Indiquez l'espèce de votre animal:</label>
<select name='species' required>";
HTML;
    $reqSpecies=MyPDO::getInstance()->prepare(<<<SQL
    SELECT speciesId, speciesName
    FROM Species
SQL);
    $reqSpecies->execute();
    $reqSpecies=$reqSpecies->fetchAll();
    foreach($reqSpecies as $species)
    {
        $conditionalSelect.="<option name='speciesl' value='{$species['speciesId']}'>{$species['speciesName']}</option>";
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

//PLANNING
$planning = <<<HTML
<style>
    table {
      border-collapse: collapse;
      letter-spacing: 1px;
      font-size: 0.8rem;
    }

    td, th {
      padding: 10px 20px;
      text-align: center;
    }
    
    th {
    font-weight: bold;
    }
    
    .buttonHr {
    border: none;
    border-radius: 10px;
    padding: 20px;
    font: inherit;
    line-height: 1;
    width: 150px;
    }
    
    .buttonHr:hover,
    .buttonHr:focus {
    transform: translateY(-0.25em);
    }
</style>

<div class="d-flex flex-column">
    <div class="d-flex justify-content-center" style="background-color: #242424; color: white; padding-top: 10px; padding-bottom: 10px; border-radius: 10px;">Du 01/10/2021 au 06/10/2021</div>
    <table>
        <colgroup>
            <col style="background-color:#C7C7C7;">
            <col span="1">
            <col style="background-color:#C7C7C7;">
            <col span="1">
            <col style="background-color:#C7C7C7;">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">Lundi</th>
                <th scope="col">Mardi</th>
                <th scope="col">Mercredi</th>
                <th scope="col">Jeudi</th>
                <th scope="col">Vendredi</th>
                <th scope="col">Samedi</th>
            </tr>
        </thead>
        <tbody>
HTML;

$horaires = ['8h00 - 9h00', '9h00 - 10h00', '10h00 - 11h00', '11h00 - 12h00', '12h00 - 13h00', '13h00 - 14h00', '14h00 - 15h00', '15h00 - 16h00', '16h00 - 17h00', '17h00 - 18h00', '18h00 - 19h00'];
$color  = "#81CB45";
foreach ($horaires as $horaire)
{
    $planning .= "<tr>";
    for ($i=0; $i<6; $i++)
    {
        $planning .= "<td><button class='buttonHr' type='submit' value='' style='background: $color;'>$horaire</button></td>";
    }
    $planning.="</tr>";
}
$planning.= <<< HTML
    </tbody>
    </table>
</div>
HTML;
//FIN PLANNING

$html= <<< HTML
<div class="d-flex flex-column justify-content-center">
    <h3 style="font-weight: bold; align-self: center">$h3</h3>
    <div class="d-flex justify-content-center">
        <form action="./trmt/prisederdv_trmt.php" method="post">
            $conditionalSelect
            <label for="veto-select">Choisissez un vétérinaire:</label>
            <select name="veto" id="veto" required>$optionsVeto</select>
            $planning
            <div class="d-flex justify-content-center p-4">$submitButton</div>
        </form>
    </div>
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();