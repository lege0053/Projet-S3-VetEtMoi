<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");

$user = $auth->getUser();
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

/////////////////
// Selects bar //
/////////////////
$vetoList = User::getVetoList();
$vetoOptions = "<option value=''>Vétérinaire</option>";
foreach ($vetoList as $veto){
    $vetoOptions .= "<option value='{$veto['userId']}'>{$veto['lastName']} {$veto['firstName']}</option>{}";
}

$speciesList = Species::getSpeciesList();
$speciesOptions = "<option value=''>Veuillez choisir une espèce</option>";
foreach ($speciesList as $species){
    $speciesOptions .= "<option value='{$species->getSpeciesId()}'>{$species->getSpeciesName()}</option>{}";
}
$animalsSelect = "<select id='animalId' name='animalId'><option value='-1'>Nouvel Animal</option></select>";
$speciesSelect = "<select id='speciesId' name='speciesId'>$speciesOptions</select>";
$vetosSelect = "<select id='vetoId' name='vetoId'>$vetoOptions</select>";

$webPage->appendJs(<<<JS

    var animalList = {};

    window.onload = function() {
        new AjaxRequest(
        {
            url: "api/getUserAnimals.php",
            method: 'get',
            handleAs: 'json',
            parameters: {
                userId: "{$user->getUserId()}"
            },
            onSuccess: function (res) {
                let animalSelect = document.getElementById('animalId');
                for(let animal in res) {
                    let option = document.createElement('option');
                    option.value = res[animal]['animalId'];
                    option.innerText = res[animal]['name'];
                    animalList[res[animal]['animalId']] = res[animal]['speciesId'];
                    animalSelect.appendChild(option);
                }
                console.log(animalList);
            },
            onError: function (status, message) {
            }
        });
        
        let animalSelect = document.getElementById('animalId');
        let speciesSelect = document.getElementById('speciesId');
        let vetoSelect = document.getElementById('vetoId');
        
        animalSelect.onchange = function(){
            if(this.options[this.selectedIndex].value == '-1')
                speciesSelect.disabled = false;
            else{
                speciesSelect.disabled = true;
                for(let i = 0; i < speciesSelect.options.length; i++){
                    let sOption = speciesSelect.options[i];
                    if(sOption.value == animalList[this.options[this.selectedIndex].value])
                        sOption.selected = true;
                    else
                        sOption.selected = false;
                }
            }
        }
        
        vetoSelect.onchange = function() {
            
        }
        
    }
JS);

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

$pageContent = <<< HTML
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

$webPage->appendContent($pageContent);
echo $webPage->toHTML();