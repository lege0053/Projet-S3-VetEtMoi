<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Accueil");

$html= <<< HTML
<div>
    <div class="d-flex justify-content-center" xmlns="http://www.w3.org/1999/html">
        <h3 style="font-weight: bold;">Une Urgence ?</h3>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <a href="#" class="btn m-1 mr-3" style="font-weight: bold;background-color: #C20D0D; color: #FFFFFF">En ligne</a>
        <a href="tel:+33325563596" class="btn m-1 ml-3" style="font-weight: bold;background-color: #C20D0D; color: #FFFFFF">03 25 56 35 96</a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="d-flex flex-column align-items-center pt-5 mr-5">
            <h2 style="font-weight: bold;">Bienvenue sur le site</h2>
            <h2 style="font-weight: bold;">de la clinique Vet&Moi !</h2>
            <br>
            <h4 style="font-weight: bold;">Prenez rendez-vous n'importe quand !</h4>
            <br>
            {$webPage->getHTMLButton(false, "Prenez rendez-vous", "takeMeeting.php", "15px", "15px", "17px")}
        </div>
        <img src="img/animal/dogAndcat.png" class="ml-5" style="max-width:40%;" alt="">
    </div>
</div>

<div class="d-flex justify-content-center">
    <img src="img/svg/background-accueil.svg" style="position: absolute; z-index: -1;">
    <div class="d-flex flex-column text-center" style="margin-top: 350px;">
        <h1 style="font-weight: bold; color: white; font-size: 64px; margin-bottom: 80px;">Espace</h1>
        <div class="d-flex flex-row mt-3">
            <a href="#">{$webPage->getImgCarre("Chien", "Chiens")}</a> 
            <a href="#">{$webPage->getImgCarre("Chat", "Chat")}</a>
            <a href="#">{$webPage->getImgCarre("nac", "NAC")}</a>
        </div>
        <br>
        <h4 style="font-weight: bold;">Voulez-vous tout savoir sur votre animal ?</h4>
        <h6 style="font-weight: bold;">Cliquez sur le type d’animal pour en apprendre plus !</h6>
        <div class="d-flex flex-column mt-5">
            <div class="d-flex flex-row">
                {$webPage->getIcon("cat")}
                <h4 style="font-weight: bold; color: #055945; border-bottom: 8px solid #02897A;">Nos Derniers Conseils</h4>
            </div>
            <div class="d-flex flex-row justify-content-center mt-3">
                <a href="#"><img src="img/carre_gris.png" alt="" height="200" class="p-2"></a> 
                <a href="#"><img src="img/carre_gris.png" alt="" height="200" class="p-2"></a> 
                <a href="#"><img src="img/carre_gris.png" alt="" height="200" class="p-2"></a> 
            </div>
            <br>
            <div class="d-flex flex-column align-items-center">
                <h4 style="font-weight: bold;">Voulez-vous plus de conseils ?</h4>
                <h6 style="font-weight: bold; padding-bottom: 10px;">Nous en avons d'autres, aussi croustillants les uns que les autres !</h6>
                {$webPage->getHTMLButton(false, "Voir les autres conseils", "./conseils.php", "15px", "15px", "16px")}
            </div>
            <div class="d-flex flex-row mt-5">
                {$webPage->getIcon("cat")}
                <h4 style="font-weight: bold; color: #055945; border-bottom: 8px solid #02897A;">Où sommes-nous situé ?</h4>
            </div>
            <section class="my-3">
                <div >
                    <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 100%">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2604.5102262308587!2d4.048937015569729!3d49.24777437932755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e9743696b72967%3A0x16942c3d585b4b98!2s226%20Bd%20Pommery%2C%2051100%20Reims!5e0!3m2!1sfr!2sfr!4v1634032967797!5m2!1sfr!2sfr" frameborder="0"
                        style="border:0" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </section>
            <div class="d-flex flex-row mt-5">
                {$webPage->getIcon("cat")}
                <h4 style="font-weight: bold; color: #055945; border-bottom: 8px solid #02897A;">Nous Contacter</h4>
            </div>
            <section>
                <div class="card-body mt-3" style="font-weight: bold;background-color: #DDDDDD; border-radius: 10px;">
                                <div class="form-header blue accent-1">
                                    <h3><i class="fas fa-envelope"></i> Ecrivez-nous !</h3>
                                </div>
                                <div class="md-form">
                                    <input type="text" id="form-name" class="mt-4 form-control" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre nom">
                                </div>
                                <div class="md-form">
                                    <input type="text" id="form-email" class="mt-2 form-control" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre mail">
                                </div>
                    <div class="md-form">
                        <input type="text" id="form-Subject" class="mt-2 form-control" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Sujet">
                    </div>
                    <div class="md-form">
                        <textarea id="form-text" class="mt-2 form-control md-textarea" rows="3" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre message"></textarea>
                    </div>
                    <div class="text-center mt-4">
                        {$webPage->getHTMLButton(true, "Envoyer", "#")}
                    </div>
                </section>
            </div>        
        </div>
    </div>
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();