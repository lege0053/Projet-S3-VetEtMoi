<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");

$user = $auth->getUser();
$webPage = new WebPage("Prise de Rendez-Vous");

$hiddenAnimalId = "";
if(isset($_POST['animalId']) && !empty($_POST['animalId'])) {
    $animalId = $_POST['animalId'];
    $hiddenAnimalId = "<input id='hiddenAnimalId' type='text' value='$animalId' hidden>";
}



// Selects bar //

$vetoList = User::getVetoList();
$vetoOptions = "";
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
        width: 130px;
        border-bottom: solid rgba(0,0,0,0) 0.25em;
        transition: transform 0.1s ease-in-out, border-bottom 0.2s ease-in-out;
    }
    
    .buttonHr:hover,
    .buttonHr:focus {
        transform: translateY(-0.25em);
        border-bottom: solid #639c35 0.25em;
    }

    .tableTitle {
        flex: 1;
        flex-grow: 1;
        text-align: center;
        padding: 20px 0 20px 0;
    }
    .tableTitle:nth-child(2n+1){
        background-color:#C7C7C7;
    }
    .tableTitle:nth-child(2n){
        background-color:#dedede;
    }
CSS);

$webPage->appendJsUrl('js/takeMeetingPopup.js');
$webPage->appendJs(<<<JS

    window.onload = function() {
    
        var animalList = {};
        
        let animalSelect = document.getElementById('animalId');
        let speciesSelect = document.getElementById('speciesId');
        let vetoSelect = document.getElementById('vetoId');
        let dateBefore = document.getElementById('dateBefore');
        let dateAfter = document.getElementById('dateAfter');
        
        let currentDay = new Date();
        let first = currentDay.getDate() - currentDay.getDay() + 1;
        let last = first + 6;
        let firstDay = new Date(currentDay.setDate(first));
        let lastDay = new Date(currentDay.setDate(last));
        
        let spanFirstDay = document.getElementById('startDate');
        spanFirstDay.innerText = firstDay.toLocaleDateString();
        let spanLastDay = document.getElementById('endDate');
        spanLastDay.innerText = lastDay.toLocaleDateString();
        
        let year = firstDay.getFullYear();
        var oneJan = new Date(firstDay.getFullYear(),0,1);
        var numberOfDays = Math.floor((firstDay - oneJan) / (24 * 60 * 60 * 1000));
        var week = Math.ceil(( firstDay.getDay() + 1 + numberOfDays) / 7);
        
        dateBefore.onclick = function() {
            backward();
            updateDate();
            reloadAvailableTimeSlot();
        }
        
        dateAfter.onclick = function() {
            forward();
            updateDate();
            reloadAvailableTimeSlot();
        }
        
        function forward(){
            firstDay = new Date(firstDay.setDate(firstDay.getDate() + 7));
            lastDay = new Date(lastDay.setDate(lastDay.getDate() + 7));
        }
        function backward() {
            firstDay = new Date(firstDay.setDate(firstDay.getDate() - 7));
            lastDay = new Date(lastDay.setDate(lastDay.getDate() - 7));
        }
        function updateDate(){
            spanFirstDay.innerText = firstDay.toLocaleDateString();
            spanLastDay.innerText = lastDay.toLocaleDateString();
            
            year = firstDay.getFullYear();
            let oneJan = new Date(firstDay.getFullYear(),0,1);
            let numberOfDays = Math.floor((firstDay - oneJan) / (24 * 60 * 60 * 1000));
            week = Math.ceil(( firstDay.getDay() + 1 + numberOfDays) / 7);
        }
        
        reloadAvailableTimeSlot();
        
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
            },
            onError: function (status, message) {
            }
        });
        
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
            reloadAvailableTimeSlot();
        }
        
        let radios = document.getElementsByName('timeSlotTypeId');
        for(let i = 0; i < radios.length; i++){
            let radio = radios[i];
            radio.onclick = function() {
                reloadAvailableTimeSlot();
            };
        }
        
        
        function clearAvailableTimeSlot(){
            let ids = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            for(let id in ids){
                let meetingDiv = document.getElementById(ids[id]);
                while(meetingDiv.firstChild){
                    meetingDiv.removeChild(meetingDiv.firstChild);
                }
            }
        }
        
        
        function addAvailableTimeSlot(res){
            for(let i = 0; i < res.length; i++){
                let radio = document.createElement('span');
                radio.className = 'buttonHr';
                radio.name = 'timeSlotId';
                radio.value = res[i]['timeSlotId'];
                radio.style.background = '#81CB45';
                radio.innerText = res[i]['startHour'].substring(0, res[i]['startHour'].length - 3);
                radio.style.textAlign = 'center';
                radio.onclick = function() {
                    radioOnClick(radio.value);
                }
                
                let div = document.getElementById(res[i]['dayName']);
                document.getElementById(res[i]['dayName']).appendChild(radio);
            }
            
            let ids = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            for(let id in ids){
                let meetingDiv = document.getElementById(ids[id]);
                if(!meetingDiv.firstChild){
                    let span = document.createElement('span');
                    meetingDiv.appendChild(span);
                }
            }
        }
        
        
        function radioOnClick(timeSlotId)
        {
            let animalId = animalSelect.options[animalSelect.selectedIndex].value;
            let speciesId = speciesSelect.options[speciesSelect.selectedIndex].value;
            let vetoId = vetoSelect.options[vetoSelect.selectedIndex].value;
            let timeSlotTypeId = document.getElementsByName('timeSlotTypeId')[0].checked ? "1" : "0";
            onOpenPopup(animalId, speciesId, vetoId, timeSlotId, timeSlotTypeId, year, week);
        }
        
        
        function reloadAvailableTimeSlot() {
            let meetingType = document.querySelector('input[name="timeSlotTypeId"]:checked').id;
            let vetoId = vetoSelect.options[vetoSelect.selectedIndex].value;
            let weekNumber = week < 10 ? '0' + week : '' + week;
            new AjaxRequest({
                url: "api/getAvailableTimeSlot.php",
                method: 'get',
                handleAs: 'json',
                parameters: {
                    meetingType: meetingType,
                    vetoId: vetoId,
                    year: year,
                    week: weekNumber
                },
                onSuccess: function (res) {
                    clearAvailableTimeSlot();
                    addAvailableTimeSlot(res);
                },
                onError: function (status, message) {
                }  
            });
        }
        
    }
JS);

$webPage->appendContent(<<<HTML

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
        $hiddenAnimalId
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

    <!-- Planning -->
    
    <div class="d-flex flex-column" style="width: 1000px;">
        <div id="dateNavBar" class="d-flex justify-content-center align-items-center" style="background-color: #242424; color: white; padding-top: 10px; padding-bottom: 10px; border-radius: 10px; column-gap: 20px;">
            <span id="dateBefore">{$webPage->getIcon('arrow-left', 28)}</span>
            <span id="date" style="display: flex; color: white; column-gap: 20px;">
                Du
                <span id="startDate" style="color: white;">??/??/????</span>
                au
                <span id="endDate" style="color: white;">??/??/????</span>
            </span>
            <span id="dateAfter">{$webPage->getIcon('arrow-right', 28)}</span>
        </div>
        
        <div class="d-flex flex-column justify-content-center align-items-center" style="margin-right: 25px; margin-left: 25px;">
             <div class="d-flex justify-content-center align-items-center" style="flex: 1; flex-grow: 1; width: 100%">
                <span class="tableTitle">Lundi</span>
                <span class="tableTitle">Mardi</span>
                <span class="tableTitle">Mercredi</span>
                <span class="tableTitle">Jeudi</span>
                <span class="tableTitle">Vendredi</span>
                <span class="tableTitle">Samedi</span>
            </div>
            <div class="d-flex justify-content-center" style="flex: 1; flex-grow: 1; width: 100%;">
                <div style="padding-bottom: 1em; background-color:#C7C7C7; flex: 1; flex-grow: 1; row-gap: 0.5em;" class="d-flex flex-column align-items-center" id="Lundi"></div>
                <div style="padding-bottom: 1em; background-color:#dedede; flex: 1; flex-grow: 1; row-gap: 0.5em;" class="d-flex flex-column align-items-center" id="Mardi"></div>
                <div style="padding-bottom: 1em; background-color:#C7C7C7; flex: 1; flex-grow: 1; row-gap: 0.5em;" class="d-flex flex-column align-items-center" id="Mercredi"></div>
                <div style="padding-bottom: 1em; background-color:#dedede; flex: 1; flex-grow: 1; row-gap: 0.5em;" class="d-flex flex-column align-items-center" id="Jeudi"></div>
                <div style="padding-bottom: 1em; background-color:#C7C7C7; flex: 1; flex-grow: 1; row-gap: 0.5em;" class="d-flex flex-column align-items-center" id="Vendredi"></div>
                <div style="padding-bottom: 1em; background-color:#dedede; flex: 1; flex-grow: 1; row-gap: 0.5em;" class="d-flex flex-column align-items-center" id="Samedi"></div>
            </div>
        </div>
    </div>

</div>

HTML);
echo $webPage->toHTML();