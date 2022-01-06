<?php
declare(strict_types=1);
require "autoload.php";
setlocale(LC_ALL, 'fr_FR', 'French_France', 'French');
date_default_timezone_set('Europe/Paris');

$userId = isset($_GET['userId']) && !empty($_GET['userId']) ? $_GET['userId'] : null;
$animalId = isset($_GET['animalId']) && !empty($_GET['animalId']) ? $_GET['animalId'] : null;
if($userId == null) {
    header('Location : accueil.php');
}

$auth = new SecureUserAuthentication();
if(!(SecureUserAuthentication::isUserConnected() || $auth->getUser()->isVeto() || $auth->getUser()->isAdmin()))
    header("Location: connexion.php");

//Configuration de base
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

.tabAnimaux th[scope=row], .tabClient th[scope=row] {
    border-right: 2px solid #828282;
}

th[scope=col] {
border-bottom: 2px solid #828282;
}

.tabAnimaux th{
    font-size: 20px;
    color:#02897A;
    width: 50%;
}

.tabVaccins th{
    width: 50%;
}

.tabVaccins td{
    font-weight: bold;
    color: #02897A;
}

.buttonNewPresta{
    font-weight: bold;
    justify-content: center;
    letter-spacing: 0.02em;
    background-color: #02897A;
    color: white;
    border-radius: 10px;
    transition: 0.2s background-color ease-in-out;
    padding: 13px;
    width: 100%;
    border:none;
}

.buttonNewPresta:hover {
    background-color: #055945;
}
.form-input-custom{
    padding: 4px 8px 4px 8px;
    border-radius: 4px;
    outline: 0;
    border:0;
    background-color: #C9C9C9;
}
CSS);


//Client
$req = MyPDO::getInstance()->prepare(<<<SQL
            SELECT *
            FROM Users
            WHERE userId = ?;
        SQL
);
$req->execute([$userId]);
$data = $req->fetch();
$user = new User($data);

//INSERTION DES ANIMAUX DU CLIENT DANS UN TABLEAU//
$tabAnimaux = "";
try {
    $animals = $user->getAnimals();
    foreach ($animals as $animal) {
        $tabAnimaux .= <<< HTML
    <tr>
        <td class="d-flex flex-row borderR" style="justify-content: space-between;">
            <div>{$animal->getName()}</div>
    HTML;
        if ($animal->getThreatId() == 1) {
            $tabAnimaux .= '<div style="height: 23px; width: 23px; background-color: limegreen; border: none; border-radius: 50%;"></div>';
        }
        if ($animal->getThreatId() == 2) {
            $tabAnimaux .= '<div style="height: 23px; width: 23px; background-color: orange; border: none; border-radius: 50%;"></div>';
        } elseif ($animal->getThreatId() == 3) {
            $tabAnimaux .= '<div style="height: 23px; width: 23px; background-color: red; border: none; border-radius: 50%;"></div>';
        }

        $tabAnimaux .= <<< HTML
        </td>
        <td class="borderR">{$animal->getSpecieName()}</td>
        <td>{$animal->getNameRace()}</td>
    </tr>
    HTML;
    }
} catch (exception $e) {
}

$html = <<< HTML
    <div class="d-flex flex-column" style="padding-top: 100px;">
        <div class="d-flex justify-content-center" style="background-color: #262626; border-radius: 10px; width: 45%; align-self: center;">
            <h3 style="font-weight: bold;background-color: #262626; color: white; font-size: 25px; margin: auto; padding: 15px;">Fiche Client</h3> 
        </div>
        <div class="d-flex justify-content-space-between" style="margin: 50px;">
            <!-- INFORMATION CLIENT -->
            <div class="d-flex flex-column" style="background-color: #C4C4C4; width: 45%; border-radius: 5px;">
                <h3 style="font-weight: bold;background-color: #262626; color: white; font-size: 23px; padding: 15px; text-align: center; border-radius: 5px 5px 0 0;">Client</h3> 
                <div class="d-flex">
                    <table class="tabClient">
                        <tr>
                            <th scope="row" style="color:#02897A; width: 120px;">Nom</th>
                            <td style="color:#02897A;">{$user->getLastName()}</td>
                        </tr>
                        <tr style="background-color: #E3E3E3;">
                            <th scope="row">Prénom</th>
                            <td>{$user->getFirstName()}</td>
                        </tr>
                        <tr>
                            <th scope="row">Adresse</th>
                            <td>{$user->getRue()}</td>
                        </tr>
                        <tr>
                            <th scope="row">CP - Ville</th>
                            <td>{$user->getCp()} - {$user->getCity()}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="background-color: #E3E3E3;">Téléphone</th>
                            <td style="background-color: #E3E3E3;">{$user->getPhone()}</td>
                        </tr>
                        <tr>
                            <th scope="row">Mail</th>
                            <td>{$user->getEmail()}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="color:#02897A; background-color: #E3E3E3;">Solde</th>
                            <td style="color:#02897A; background-color: #E3E3E3;">0.00</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-space-between" style="margin: 12px;">
                    <input type='buttonNewPresta' class='button' value='Envoyer un SMS' style="text-align: center;" >
                    <input type='buttonNewPresta' class='button' value='Envoyer un Email' style="text-align: center;">
                    <form action="nouvelle_prestation.php" method="post">
                        <input type="text" hidden name="animalId" value="">
                        <button class="buttonNewPresta" type="submit" name="animalId" value="{$userId}">Nouvelle Prestation</button>
                    </form>
                </div>
            </div>
            <!-- TOUS LES ANIMAUX DU CLIENT -->
            <div class="d-flex flex-column" style="width: 45%; background-color: #E3E3E3; border-radius: 5px;">
                <h3 style="font-weight: bold;background-color: #262626; color: white; font-size: 23px; padding: 15px; text-align: center; border-radius: 5px 5px 0 0;">Animaux du Client</h3> 
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
HTML;

//Animal sélectionné
try {
    $animalSelect = Animal::createFromId($animalId);

    $age = date_diff(date_create($animalSelect->getBirthDay()), date_create("now"))->format("%y ans %m mois");
    $dateNais = ucwords(utf8_encode(strftime("%A %d %b %Y - %H:%M", strtotime($animalSelect->getBirthDay()))));
    if($animalSelect->getDeathDay() == null) {
        $dateDeath = '';
    } else {
        $dateDeath = ucwords(utf8_encode(strftime("%A %d %b %Y - %H:%M", strtotime($animalSelect->getBirthDay()))));
    }
    if ($animalSelect->getTatoo() == null) {
        $tatoo = '';
    } else{
        $tatoo = $animalSelect->getTatoo();
    }
    if($animalSelect->getChip() == null)
    {
        $puce = '';
    } else {
        $puce = $animalSelect->getChip();
    }
    if($animalSelect->getComment() == null){
        $remarque = '';
    }
    else {
        $remarque = $animalSelect->getComment();
    }
    if($animalSelect->getDress() == null)
    {
        $dress = '';
    }
    $dress = $animalSelect->getDress();

    if($animalSelect->getWeight() == null) {
        $weight = '';
    } else{
        $weight = $animalSelect->getWeight();
    }

    $html.= <<< HTML
        <!-- FICHE ANIMAL DU CLIENT -->
        <div class="d-flex flex-column" style="background-color: #E3E3E3; margin: 20px 50px 20px 50px;">
            <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%; border-radius: 5px 5px 0 0;">Fiche Animal du Client</h3> 
            <div class="d-flex flex-row">
                <div class="d-flex flex-column" style="width: 50%; border-right: 15px solid #C4C4C4;">
                    <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%;">Information général</h3> 
                    <div class="d-flex flex-row" style="column-gap: 10px;">
                        <div>{$webPage->getImgCarre("{$animalSelect->getSpecieName()}", $animalSelect->getName(), 330)}</div>
                        <div class="d-flex flex-row" style="column-gap: 50px;">
                            <div class="d-flex flex-column justify-content-center" style=" font-size: 18px;">
                                <div>
                                    <p style="margin: 0; font-weight: bold; color:#02897A; height: 28px;">Nom</p>
                                    <p style="height: 28px;">{$animalSelect->getName()}</p> 
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: bold; color:#02897A; height: 28px;">Race</p>
                                    <p style="height: 28px;">{$animalSelect->getNameRace()}</p>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: bold; color:#02897A; height: 28px;">Genre</p>
                                    <p style="height: 28px;">{$animalSelect->getGenderName()}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center" style=" font-size: 18px;">
                                <div>
                                    <p style="margin: 0; font-weight: bold; color:#02897A; height: 28px;">Espèce</p>
                                    <p style="height: 28px;">{$animalSelect->getSpecieName()}</p>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: bold; color:#02897A; height: 28px;">Robe</p>
                                    <p style="height: 28px;">$dress</p>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: bold; color:#02897A; height: 28px;">Poids</p>
                                    <p style="height: 28px;">$weight</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 18px; margin: 30px 0 30px 25px;">
                        <p style="margin: 0; font-weight: bold; color:#02897A;">Age</p> 
                        <p>$age</p>
                        <p style="margin: 0; font-weight: bold; color:#02897A;">Date de Naissance</p> 
                        <p>$dateNais</p>
                         <p style="margin: 0; font-weight: bold; color:#02897A;">Date de Décès</p> 
                        <p>$dateDeath</p>
                        <p style="margin: 0; font-weight: bold; color:#02897A;">Tatouage</p> 
                        <p>$tatoo</p>
                        <p style="margin: 0; font-weight: bold; color:#02897A;">N° Puce</p> 
                        <p>$puce</p>
                        <p style="margin: 0; font-weight: bold; color:#02897A;">Remarque</p> 
                        <p>$remarque</p>
                    </div>
                </div>
                <div class="d-flex flex-column" style="width: 50%;">
                    <div class="d-flex flex-column" style="height: 50%">
                        <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%;">
                            <span style="padding-right: 180px;">{$webPage->getIcon('arrow-left', 28)}</span>Historique<span style="padding-left: 180px;">{$webPage->getIcon('arrow-right', 28)}</span>
                        </h3> 
                    </div>
                    <div class="d-flex flex-column" style="height: 50%">
                        <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%;">Vaccins</h3> 
                        <table class="tabVaccins">
                            {$animalSelect->getTableVaccin()}
                        </table>                
                    </div>
                </div>
            </div>
        </div>
    </div>
    HTML;
    $webPage->appendContent($html);
}catch (exception $e) {
    //SpeciesList
    $speciesList = Species::getSpeciesList();
    $speciesOptions = "<option value='''>Espèce</option>";
    foreach ($speciesList as $species){
        $speciesOptions .= "<option value='{$species->getSpeciesId()}'>{$species->getSpeciesName()}</option>{}";
    }
    $speciesSelect = "<select class='form-select' style='background-color: #C9C9C9; border: none; color: gray;width: 100%;' id='species' name='species' required>$speciesOptions</select>";

    //RacesList
    $racesList = Race::getRacesList();
    $raceOptions = "<option value='''>Race</option>";
    foreach ($racesList as $race){
        $raceOptions .= "<option value='{$race->getRaceId()}'>{$race->getRaceName()}</option>{}";
    }
    $raceSelect = "<select class='form-select' style='background-color: #C9C9C9; border: none; color: gray;width: 100%;' id='race' name='race' required>$raceOptions</select>";

    //GenderList
    $genderList = (new GenderStatus)->getGenderStatusList();
    $genderOptions = "<option value='''>Genre</option>";
    foreach ($genderList as $gender){
        $genderOptions .= "<option value='{$gender->getGenderId()}'>{$gender->getGenderName()}</option>{}";
    }
    $genderSelect = "<select class='form-select' style='background-color: #C9C9C9; border: none; color: gray;width: 100%;' id='gender' name='gender' required>$genderOptions</select>";

    //ThreatList
    $threatList = (new Threat)->getThreatList();
    $threatOptions = "<option value='''>Dangerosité</option>";
    foreach ($threatList as $threat){
        $threatOptions .= "<option value='{$threat->getThreatId()}'>{$threat->getThreatName()}</option>{}";
    }
    $threatSelect = "<select class='form-select' style='background-color: #C9C9C9; border: none; color: gray;width: 100%;' id='threat' name='threat' required>$threatOptions</select>";

    $html .= <<< HTML
    <div class="d-flex flex-column" style="background-color: #E3E3E3; margin: 20px 50px 20px 50px;">
        <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%; border-radius: 5px 5px 0 0;">Ajouter un Nouvel Animal</h3> 
        <div class="d-flex flex-row">
            <div class="d-flex flex-column" style="width: 50%; border-right: 15px solid #C4C4C4;">
                <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%;">Information général</h3> 
                <div class="d-flex flex-column pt-2 pr-5 pl-5">
                    <form action="trmt/ajouterAnimal_trmt.php" method="post"">
                        <!--Nom-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Nom</div>
                            </div>
                            <input type="text" id="nom" name="nom" class="form-input-custom" placeholder="Nom" required>
                        </div>
                        <!--Espèce-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}                                
                                <div style="font-weight: bold;">Espèce</div>
                            </div>
                            <div class="form-input-custom">$speciesSelect</div>
                        </div>
                        <!--Race-->
                        <div class="form-group d-flex flex-column">
                            <div style="font-weight: bold;" class="d-flex flex-row">
                                    {$webPage->getIcon("cat")}
                                    <div style="font-weight: bold;">Race</div>
                            </div>
                            <div class="form-input-custom">$raceSelect</div>
                        </div>
                        <!--Genre-->
                        <div class="form-group d-flex flex-column">
                            <div style="font-weight: bold;" class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Genre</div>
                            </div>
                            <div class="form-input-custom">$genderSelect</div>
                        </div>
                        <!--Robe-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Robe</div>
                            </div>
                            <input type="text" id="dress" name="dress" class="form-input-custom" placeholder="Robe">
                        </div>
                        <!--Poids-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Poids</div>
                            </div>
                            <input type="text" id="poids" name="poids" class="form-input-custom" placeholder="Poids">
                        </div>
                        <!--Dangerosité-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Dangerosité</div>
                            </div>
                            <div class="form-input-custom">$threatSelect</div>
                        </div>
                        <!--Date de Naissance-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Date de naissance</div>
                            </div>
                            <input type="date" id="birth" name="birth" class="form-input-custom" placeholder="Date de naissance" required>
                        </div>
                        <!--Tatouage-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">Tatouage</div>
                                
                            </div>
                            <input type="text" id="tatoo" name="tatoo" class="form-input-custom" placeholder="Tatouage">
                        </div>
                        <!--N° Puce-->
                        <div class="form-group d-flex flex-column">
                            <div class="d-flex flex-row">
                                {$webPage->getIcon("cat")}
                                <div style="font-weight: bold;">N° Puce</div>
                            </div>
                            <input type="text" id="chip" name="chip" class="form-input-custom" placeholder="N° Puce">
                        </div>
                        <!--userId-->
                        <input id="userId" name="userId" type="hidden" value=$userId>
                        <!--Bouton submit Ajouter-->
                        <div class="d-flex flex-row justify-content-center">
                            <div class="form-group d-inline-flex">
                                {$webPage->getHTMLButton(true, "Ajouter")}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-column" style="width: 50%;">
                <div class="d-flex flex-column" style="height: 50%">
                    <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%;">
                        <span style="padding-right: 180px;">{$webPage->getIcon('arrow-left', 28)}</span>Historique<span style="padding-left: 180px;">{$webPage->getIcon('arrow-right', 28)}</span>
                    </h3> 
                </div>
                <div class="d-flex flex-column" style="height: 50%">
                    <h3 style="background-color: #262626; color: white; font-size: 25px; font-weight: bold; padding: 15px; text-align: center; width: 100%;">Vaccins</h3> 
                    <table class="tabVaccins"></table>        
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
    $webPage->appendContent($html);
}
echo $webPage->toHTML();