<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");

$webPage = new WebPage("Prise de Rendez-Vous");
$webPage->appendCss(<<<CSS
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
CSS);

$hiddenAnimalId = "";
if(isset($_POST['animalId']) && !empty($_POST['animalId'])) {
    $animalId = $_POST['animalId'];
    $hiddenAnimalId = "<input id='hiddenAnimalId' type='text' value='$animalId' hidden>";
}

$animalsSelect = "<select id='animalId' name='animalId'><option value=''>Nouvel Animal</option></select>";
$speciesSelect = "<select id='speciesId' name='speciesId'><option value=''>Veuillez choisir une espèce</option></select>";
$vetosSelect = "<select id='vetoId' name='vetoId'><option value=''>Vétérinaire</option></select>";

//PLANNING
$planning = <<<HTML
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
<div class="d-flex flex-column justify-content-center align-items-center">
    <span class="title main-ui-class" style="margin-top: 50px; margin-bottom: 30px;">Prise de Rendez-Vous</span>
    <div class="d-flex justify-content-center align-items-center" style="margin: 1em; column-gap: 2em;">
        <div class="d-flex flex-column">
            <span style="font-size: 1.25em;">Animal</span>
            $animalsSelect
        </div>
        <div class="d-flex flex-column">
            <span style="font-size: 1.25em;">Espèce</span>
            $speciesSelect
        </div>
        <div class="d-flex flex-column">
            <span style="font-size: 1.25em;">Vétérinaire</span>
            $vetosSelect
        </div>
        <div class="d-flex flex-column">
            <span style="font-size: 1.25em;">Lieu</span>
            <div class="d-flex justify-content-center align-items-center" style="column-gap: 0.25em">
                <input type="radio" id="clinique" name="timeSlotTypeId" value="1" checked><label style="margin: 0; padding: 0;" for="clinique">Clinique</label>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="column-gap: 0.25em">
                <input type="radio" id="domicile" name="timeSlotTypeId" value="2"><label for="domicile" style="margin: 0; padding: 0;">Domicile</label>
            </div>
        </div>
    </div>
    $planning
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();