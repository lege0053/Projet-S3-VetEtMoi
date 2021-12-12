<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()) header("Location: connexion.php");
$user = $auth->getUser();
if(!$user->isVeto()) header('Location: accueil.php');

$webPage = new WebPage("Planning");

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

$webPage->appendJs(<<<JS

    window.onload = function() {
    
        let dateBefore = document.getElementById('dateBefore');
        let dateAfter = document.getElementById('dateAfter');
        let vetoId = {$user->getUserId()}
        
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
        
        
        function addMeeting(res){
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
        
        
        function radioOnClick(radioId)
        {
            console.log("Radio OnClick");
        }
        
        
        function reloadAvailableTimeSlot() {
            let weekNumber = week < 10 ? '0' + week : '' + week;
            new AjaxRequest({
                url: "api/getVetoPlanning.php",
                method: 'get',
                handleAs: 'json',
                parameters: {
                    vetoId: vetoId,
                    year: year,
                    week: weekNumber
                },
                onSuccess: function (res) {
                    clearAvailableTimeSlot();
                    addMeeting(res);
                },
                onError: function (status, message) {
                }  
            });
        }
        
    }
JS);

$webPage->appendContent(<<<HTML
<div class="d-flex flex-column justify-content-center align-items-center">
    <span class="title main-ui-class" style="margin-top: 50px; margin-bottom: 30px;">Planning de la semaine</span>

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