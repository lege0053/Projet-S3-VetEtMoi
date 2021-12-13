<?php
declare(strict_types=1);
require "autoload.php";
$webPage = new WebPage("Conseils");

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
                parameters: {
                },
                onSuccess: function (res) {
                    
                },
                onError: function (status, message) {
                }  
            });
    
JS);



$webPage->appendContent($html);
echo $webPage->toHTML();