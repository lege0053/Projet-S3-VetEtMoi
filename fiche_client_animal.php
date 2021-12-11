<?php
declare(strict_types=1);
require "autoload.php";

$webPage = new WebPage("Fiche Client");
$webPage->appendCss(<<<CSS
.borderR {
    border-right: 2px solid #828282;
}


table {
  table-layout: fixed;
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px;
}

th {
font-weight: bold;
}

th[scope=row] {
    border-right: 2px solid #828282;
}


th[scope=col] {
border-bottom: 2px solid #828282;
}

.tabAnimaux th{
font-size: 20px;
color:#02897A;
}

.tavAnimaux tbody tr {
border-right: 2px solid #828282 ;
}
CSS);

//INFORMATION ANIMAUX DU CLIENT ET INSERTION DANS UN TABLEAU//
$tabAnimaux="";
$animauxDuClient = [['name' =>'Rocky', 'species' => 'Chien', 'threat' => 'Faible', 'race' => 'Labrador'], ['name' => 'Gribouille', 'species' => 'Chat', 'threat' => 'Moyen', 'race' => 'Men Coon']];
foreach ($animauxDuClient as $animalDuClient) {
    $tabAnimaux .= <<< HTML
<tr>
    <td class="d-flex flex-row borderR" style="justify-content: space-between;">
        <div>{$animalDuClient['name']}</div>
        <div><img src="img/greenCircle.png" alt="Dangerosité faible" height="23px;"</div>
    </td>
    <td class="borderR">{$animalDuClient['species']}</td>
    <td>{$animalDuClient['race']}</td>
</tr>
HTML;
}

$html = <<< HTML
<div class="d-flex flex-column" style="padding-top: 100px;">
    <div class="d-flex justify-content-center" style="background-color: #262626; border-radius: 10px; width: 45%; align-self: center;">
        <h3 class="title" style="background-color: #262626; color: white; font-size: 25px; margin: auto; padding: 15px;">Fiche Client</h3> 
    </div>
    <div class="d-flex justify-content-space-between" style="margin: 50px;">
        <!-- INFORMATION CLIENT -->
        <div class="d-flex flex-column" style="background-color: #C4C4C4;width: 45%">
            <h3 class="title" style="background-color: #262626; color: white; font-size: 20px; padding: 15px; text-align: center">Client</h3> 
            <div class="d-flex">
                <table class="tabClient">
                    <tr>
                        <th scope="row" style="color:#02897A; width: 120px;">Nom</th>
                        <td style="color:#02897A;">DUPONT</td>
                    </tr>
                    <tr style="background-color: #E3E3E3;">
                        <th scope="row">Prénom</th>
                        <td>Jean</td>
                    </tr>
                    <tr>
                        <th scope="row">Adresse</th>
                        <td>55 Bis Rue Ernest Vallée</td>
                    </tr>
                    <tr>
                        <th scope="row">CP - Ville</th>
                        <td>02310, NOGENT L'ARTAUD</td>
                    </tr>
                    <tr>
                        <th scope="row" style="background-color: #E3E3E3;">Téléphone</th>
                        <td style="background-color: #E3E3E3;">0683254863</td>
                    </tr>
                    <tr>
                        <th scope="row">Mail</th>
                        <td>jeandupont@orange.fr</td>
                    </tr>
                    <tr>
                        <th scope="row" style="color:#02897A; background-color: #E3E3E3;">Solde</th>
                        <td style="color:#02897A; background-color: #E3E3E3;">0.00</td>
                    </tr>
                </table>
            </div>
            <div class="d-flex justify-content-space-between" style="margin: 12px;">
                <input type='button' class='button' value='Envoyer un SMS' style='padding: 11px 24px; font-size: 17px; '>
                <input type='button' class='button' value='Envoyer un email' style='padding: 11px 24px; font-size: 17px; '>
                <input type='submit' class='button' value='Nouvelle prestation' style='padding: 11px 24px; font-size: 17px; '>
            </div>
        </div>
        <!-- TOUS LES ANIMAUX DU CLIENT -->
        <div class="d-flex flex-column" style="width: 45%; background-color: #E3E3E3;">
            <h3 class="title" style="background-color: #262626; color: white; font-size: 20px; padding: 15px; text-align: center">Animaux du Client</h3> 
            <table class="tabAnimaux">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Espèce</th>
                        <th scope="col">Race</th>
                    </tr>
                </thead>
                <tbody>
                    $tabAnimaux
                </tbody>
            </table>
        </div>
        
    </div>
</div>

HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();