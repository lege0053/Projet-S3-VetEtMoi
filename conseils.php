<?php
declare(strict_types=1);
require "autoload.php";
$webPage = new WebPage("Conseils");

$html= <<< HTML
<img src="img/animal/chat-chien.png" class="" style="max-width:100%;" alt="">

<div style="display: flex; flex-direction: column; margin: 30px; row-gap: 30px;">
    <div class="d-flex justify-content-center align-items-center" style="background: #F3F4F5; border-radius: 26px; padding: 25px;">
        <img src="img/animal/cat2.png" style="width: 200px;" alt="">
        <div class="d-flex flex-column align-items-center">
            <h2 style="font-weight: bold;">Conseil pour la santé de votre chat</h2>
            <ul class="" style="font-weight: bold;list-style-type: none;background: #DDDDDD;border-radius: 20px;padding:10px 50px;">
                <li style=""> Vaccination : 
                    <span style="font-weight: normal;"> la vaccination contre le typhus (T) et le coryza (C), recommandée même pour les chats qui restent en appartement, reste nécessaire tous les ans. En revanche, la leucose (L) (sorte de SIDA chez le chat) et la rage (R) ne sont à faire que tous les 2 ans.</pan> 
                </li>
                <li> Maladie :
                <span style="font-weight: normal;"> le Coriza, La Rhinotrachéite Virale Féline (RVF), Le F.I.V. ou sida du chat...  </pan> 
                </li>
                <li> Alimentation : <span style="font-weight: normal;"> nourriture humide ou sèche ?, alimentation pour chat castré... </span>  </li>
                <li> castration : <span style="font-weight: normal;">  Age, recommandation... </span> </li>
                
            </ul>
            <a href="https://example.com">Suivez ce lien pour voir tous les conseils</a>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="background: #F3F4F5; border-radius: 26px; padding: 25px;">
        <img src="img/animal/chienConseil3.png" style="height: auto; width: 200px;" alt="">
        <div class="d-flex flex-column align-items-center">
            <h2 style="font-weight: bold;">Conseil pour la santé de votre chien</h2>

            <ul style="font-weight: bold;list-style-type: none;background: #DDDDDD;border-radius: 20px;padding:10px 50px;">
                <li> Vaccination :
                    <span style="font-weight: normal;">maladie de Carré,Parvovirose,leptospirose ictérigène,Hépatite contagieuse,Toux des chenils,Rage...</span>
                </li>
                <li> Maladie :
                <span style="font-weight: normal;">La Maladie du Carré, La gastro-entérite infectieuse,La maladie de Lyme, La dilatation-torsion de l'estomac, La piroplasmose, La cystite, Le tétanos...</span>
                </li>
                <li> nutrition :
                    <span style="font-weight: normal;"> croquettes adaptées pour votre éspèce et son âge...  </span>
                </li>
                <li> castration :
                <span style="font-weight: normal;"> Age, recommandation...  </span>
                </li>
                
            </ul>
            <a href="https://example.com">Suivez ce lien pour voir tous les conseils</a>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center" style="background: #F3F4F5; border-radius: 26px; padding: 25px;">
        <img src="img/animal/hamster2.png" style="width: 200px;" alt="">
        <div class="d-flex flex-column align-items-center">
            <h2 style="font-weight: bold;">Conseil pour la santé de votre NAC</h2>
            <ul style="font-weight: bold;list-style-type: none;background: #DDDDDD;border-radius: 20px;padding:10px 50px;">
                <span style="font-weight: normal;">Dans cette rubrique, vous trouverez des renseignements 
                sur les différents soins à apporter à votre animal, ainsi que différents conseils pour prendre soins d’eux. 
                Cet espace est accessible à tous les propriétaires, n’hésitez pas à partager.</span>
            </ul>

            <a href="https://example.com">Suivez ce lien pour voir tous les conseils</a>
        </div>
    </div>
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();