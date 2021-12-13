<?php
declare(strict_types=1);
require "autoload.php";
$webPage = new WebPage("liste_clients");

$html= <<< HTML
<div class='d-flex align-items-center flex-column ' style='row-gap:2em; width:100%; margin-top: 2.5em;'>
    <span class='title main-ui-class'> Liste des Clients </span>

    <div class="d-flex justify-content-center flex-column main-ui-class">
        <div class="d-flex justify-content-center align-items-center" style="gap: 0.5em;">
            <label for='search-bar' style="margin: 0; font-size: 1.35em;">Nom:</label> 
            <input type="search" id="search-bar" placeholder="Rechercher..." style="padding: 10px; border-radius: 10px; width: 300px;"> 
        </div>
        <div id="liste-clients"></div>
        
    </div>

</div>
HTML;

$webPage->appendJs(<<<JS
    new AjaxRequest({
                url: "api/getListClients.php",
                method: 'get',
                handleAs: 'json',
                parameters: {},
                onSuccess: function (res) {
                    let listeCli = document.getElementById('liste-clients');
                    for(let i=0 ; i<listeCli.length ; i++)
                    {
                        let clientName = docunment.createElement('span');
                        clientName.style.width = '800px';
                        clientName.style.backgroundColor = '#DDDDDD';
                        clientName.style.padding = '25px';
                        clientName.style.borderRadius = '20px';
                        clientName.innerText = res[i]['lastName'] + " " + res[i]['firstName'];
                        clientName.onclick = function(){
                            location.href = 'fiche_client_animal.php?userId=' + res[i]['userId'] + "&animalId=null";
                            
                        }
                        listeCli.appendChild(clientName);
                    }  
                },
                onError: function (status, message) {
                }  
            });
    
JS);



$webPage->appendContent($html);
echo $webPage->toHTML();